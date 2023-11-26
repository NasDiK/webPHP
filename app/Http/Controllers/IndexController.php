<?

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Person;

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
}
?>