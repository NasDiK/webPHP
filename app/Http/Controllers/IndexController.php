<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\MasterClass;
use App\Models\MasterClassRegistration;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;

class IndexController extends Controller
{
    public function index()
    {
        return view('index', [
            'registrations' => Auth::user()->registrations ?? []
        ]);
    }

    public function activity(Request $request)
    {
        if (isset($request->id)) {
            $activity = Activity::findOrFail($request->id);
        } else {
            $activity = Activity::where('name', $request->name)->first();
        }

        $master_classes = $activity->master_classes;

        $master_classes = $master_classes->map(
            function ($master_class) {
                $master_class['hasRecord'] = $master_class->registrations->contains('userId', Auth::user()->id ?? 0);

                return $master_class;
            },
            $master_classes
        );

        return view('activity', [
            'activity' => $activity,
            'master_classes' => $master_classes
        ]);
    }

    public function profile()
    {
        if (Auth::user()->roleName === 'VISITOR') {
            return redirect()->route('index');
        }

        return view('profile', [
            'user' => Auth::user(),
            'master_classes' => Auth::user()->creator_master_classes
        ]);
    }

    public function addMasterClass()
    {
        if (Auth::user()->roleName === 'VISITOR') {
            return redirect()->route('index');
        }

        return view('addMasterClass', [
            'activity' => Activity::all()
        ]);
    }

    public function storeMasterClass(Request $request)
    {
        if (Auth::user()->roleName === 'VISITOR') {
            return redirect()->route('index');
        }

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:now',
            'time' => 'required|date_format:H:i',
            'cost' => 'required|numeric',
            'limit' => 'required|numeric',
            'activityId' => 'required|numeric|exists:activity,id'
        ]);

        $data = $request->all();
        $data['startAt'] = Carbon::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['time'])->format('Y-m-d H:i:s');

        unset($data['date']);
        unset($data['time']);

        $data['creatorId'] = Auth::user()->id;
        $masterClass = new MasterClass($data);
        $masterClass->save();

        return redirect()->route('profile');
    }

    public function registration($masterClassId)
    {
        if (!isset(Auth::user()->id)) {
            return redirect()->route('index');
        }

        $masterClass = MasterClass::findOrFail($masterClassId);

        if (!$masterClass->canRegister) {
            redirect()->route('index');
        }

        return view('registration', [
            'masterClass' => $masterClass,
            'user' => Auth::user(),
            'time' => Date::parse($masterClass->startAt)->format('H:i'),
            'date' => Date::parse($masterClass->startAt)->format('j F')
        ]);
    }

    public function courseRegister($masterClassId)
    {
        if (!isset(Auth::user()->id)) {
            return redirect()->route('index');
        }

        $masterClass = MasterClass::findOrFail($masterClassId);

        if (!$masterClass->canRegister || Auth::user()->id === $masterClass->creatorId) {
            redirect()->route('index');
        }

        $registration = new MasterClassRegistration([
            'userId' => Auth::user()->id,
            'masterClassId' => $masterClassId
        ]);

        $registration->save();

        return redirect()->route('activity', ['id' => $masterClass->activityId])->with('status', 'Вы успешно записаны на курс');
    }

    public function masterClass($id)
    {
        if (Auth::user()->roleName === 'VISITOR') {
            return redirect()->route('index');
        }

        $masterClass = MasterClass::findOrFail($id);

        return view('masterClass', [
            'masterClass' => $masterClass,
            'time' => Date::parse($masterClass->startAt)->format('H:i'),
            'date' => Date::parse($masterClass->startAt)->format('Y-m-d')
        ]);
    }

    public function updateMasterClass(Request $request, $id)
    {
        if (Auth::user()->roleName === 'VISITOR') {
            return redirect()->route('index');
        }

        $request->validate([
            'description' => 'required|string',
            'cost' => 'required|numeric',
        ]);

        $masterClass = MasterClass::findOrFail($id);

        $masterClass['cost'] = $request['cost'];
        $masterClass['description'] = $request['description'];

        $masterClass->save();

        return redirect()->route('profile');
    }

    public function getEmptyTimeByDate(Request $request)
    {
        if (Auth::user()->roleName === 'VISITOR') {
            return redirect()->route('index');
        }

        $masterClasses = MasterClass::whereDate('startAt', $request['date'])->get();

        $times = $masterClasses->map(
            function ($masterClass) {
                return Date::parse($masterClass->startAt)->format('H:i');
            },
            $masterClasses
        );

        return $times;
    }
}
