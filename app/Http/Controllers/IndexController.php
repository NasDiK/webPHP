<?

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function index()
  {
    $header = 'Резюме и вакансии';
    
    return view('mainpage', ['header' => $header]);
  }

  public function show()
  {
    $data = [
      'lastName' => 'Иванов',
      'position' => 'Программист',
      'phoneNumber' => '55-55-55',
      'experience' => '4 года',
      'avatar' => 'ava1.jpg'
    ];

    return view('resume', ['data' => $data]);
  }
}
?>