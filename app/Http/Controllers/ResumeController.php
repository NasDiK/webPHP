<?

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Staff;
use DateTime;
use Illuminate\Support\Facades\Redirect;

class ResumeController extends Controller
{
  public function index()
  {
    $header = 'Резюме и вакансии';
    
    return view('mainpage', ['header' => $header]);
  }

  public function showAddPersonPage() {
    $result = null;

    return view('add-content', [
      'addResult' => $result,
      'staffs' => Staff::all()
    ]);
  }

  public function showEditPersonPage(int $id) {
    $person = $this->getPersonInfoById($id);

    return view('add-content', [
      'staffs' => Staff::all(),
      'addResult' => null,
      'editPerson' => $person
    ]);
  }

  public function showPersonResume(int $userId)
  {  
    $userData = $this->getPersonInfoById($userId);

    return view('resume', ['userData' => $userData]);
  }

  public function getPersonInfoById($personId) {
    $personModel = Person::find($personId);

    return $personModel;    
  }

  //----CRUD

  public function addResume(Request $request) {
    $formData = $request->all();

    $newResume = new Person;

    $request->validate([
      'FIO' => 'required|max:255',
      'Phone' => 'required|numeric',
      'Stage' => 'required|numeric',
      'Staff' => 'required|numeric',
      'Image' => 'required'
    ]);

    $fileName = time() . '.' . $request->Image->extension();
    $formData['Image']->storeAs('public/images', $fileName);

    $newResume->FIO = $formData['FIO'];
    $newResume->created_at = new DateTime();
    $newResume->Phone = $formData['Phone'];
    $newResume->Stage = $formData['Stage'];
    $newResume->Staff = $formData['Staff'];
    $newResume->Image = $fileName;
    $newResume->save();

    return redirect('/resume/add')->with([
      'addResult' => "Was added with id #$newResume->id",
      'staffs' => Staff::all()
    ]);
  }

  public function deleteResume(int $id, Request $request) {
    $person = $this->getPersonInfoById($id);
    $person->delete();

    return Redirect::back();
  }

  public function updateResume(Request $request) {
    // dd($data);
  }
}
?>