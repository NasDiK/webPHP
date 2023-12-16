<?

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Rubric;
use App\Models\Staff;
use App\Models\Statya;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
  public function index()
  {
      return view('index', [
          'news' => Statya::orderBy('created_at', 'desc')->paginate(5),
          'role' => Auth::user()->roleName ?? 'STUDENT'
      ]);
  }

  public function add()
  {
      return view('add', [
          'rubrics' => Rubric::all()
      ]);
  }

  public function rubric($id)
  {
      $rubric = Rubric::findOrFail($id);

      return view('rubric', [
          'rubric' => $rubric,
          'news' => $rubric->news,
          'role' => Auth::user()->roleName ?? 'STUDENT'
      ]);
  }

  public function statya($id)
  {
      return view('statya', [
          'statya' => Statya::findOrFail($id)
      ]);
  }

  public function storeNews(Request $request)
  {
      if (Auth::user()->roleName === 'ADMIN') {
          redirect()->route('index');
      }

      $request->validate([
          'title' => 'required|max:255',
          'lid' => 'required',
          'rubrics' => 'required|numeric',
          'content' => 'required',
          'image' => 'required'
      ]);

      if ($request->hasFile('image')) {
          $photo = $request->file('image');
          $path = $photo->store('photos', 'public');
      }

      $data = $request->all();
      $data['image'] = $path;
      $statya = new Statya();
      $statya->fill($data);
      $statya->save();

      return redirect()->route('statya', ['id' => $statya->id]);
  }

  public function deleteNews($id, $from)
  {
      $statya = Statya::findOrFail($id);

      if (Auth::user()->roleName === 'ADMIN') {
          return redirect()->route('rubric', ['id' => $statya->rubrics]);
      }

      $statya->delete();

      if ($from === 'rubric') {
          return redirect()->route('rubric', ['id' => $statya->rubrics]);
      }
      else {
          return redirect()->route('index');
      }
  }
}
?>