<?

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Staff;

class IndexController extends Controller
{
  public function index()
  {
    $header = 'Резюме и вакансии';
    
    return view('mainpage', [
      'header' => $header,
      'persons' => Person::all()
    ]);
  }

  public function staffsList()
  {
    return view('lab9Queries.liststaff', [
      'staffs' => Staff::all()
    ]);
  }

  public function firstQuery($from = 5, $to = 15) {
    $data = Person::whereBetween('Stage', [$from, $to])->get();
    
    return view('lab9Queries.first', [
      'Persons' => $data
    ]);
  }

  public function secondQuery() {
    $data = Person::join('Staff', 'Person.Staff', '=', 'Staff.id')
      ->where('Staff.staff', 'Программист')->get();
    
    return view('lab9Queries.second', [
      'Persons' => $data
    ]);
  }

  public function thirdQuery() {
    $data = Person::count();

    return view('lab9Queries.third', [
      'count' => $data
    ]);
  }

  public function fourthQuery() {
    $data = Staff::whereHas('Person')->get();

    return view('lab9Queries.fourth', [
      'Staffs' => $data
    ]);
  }
}
?>