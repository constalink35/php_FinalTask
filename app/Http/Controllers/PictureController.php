<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $uploadFile;


    public function __construct(FileController $uploadFile)
    {
        $this->uploadFile = $uploadFile;
    }

    public function index()
    {

        $pictures =Picture::join('users','user_id','=','users.id')
            ->select('pictures.*', 'users.name')
            ->orderBy('pictures.id','desc')
            ->paginate(6);


        return view('index',compact('pictures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = $this->uploadFile->save($request);
        return redirect(route('create'))->withSuccess($res);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $picture=Picture::find((int)$id);
        $picture->count_view +=1;
        $picture->save();

        $picture =Picture::join('users','user_id','=','users.id')
            ->select('pictures.*', 'users.name')
            ->where ('pictures.id',$id)->first();

        $tags = $picture->tags()->get();

        return view('show',compact('picture','tags'));
    }

    public function showtag($id)
    {
        $tag=Tag::find((int)$id);

        $pictures = $tag->pictures()
            ->join('users','user_id','=','users.id')
            ->select('pictures.*', 'users.name')
            ->orderBy('pictures.id','desc')
            ->paginate(6);

        $tagFilter ='Фото с тегом: #'.$tag->name;
        return view('index',compact('pictures','tagFilter'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $picture =Picture::join('users','user_id','=','users.id')
            ->select('pictures.*', 'users.name')
            ->where ('pictures.id',$id)->first();

        if ($picture->user_id != Auth::id()){
            return route('index')->withErrors('Вы не можете редактировать эти данные ');
        }
        $tags=$picture->tags()->get();
        $strtags = '';
        foreach ($tags as $tag){
            $strtags.=$tag->name.',';
        }
        return view('edit',compact('picture','strtags'));

    }

    //Обновление записи из таблицы Pictures
    public function update(Request $request, $id)
    {
        $picture=Picture::find((int)$id);

        if ($picture->user_id != Auth::id()){
            return redirect()->route('index')->withErrors('Вы не можете редактировать это изображение ');
        }

        $picture->descript = htmlspecialchars($request->description);
        $picture->save();

        $tagIds =TagController::store($request->tags);
        $picture->tags()->sync($tagIds);
        return redirect()->route('show',compact('id'))->with('success','Данные успешно обновлены');

    }

    // удаление записи из таблицы Pictures
    public function destroy($id)
    {
        $picture=Picture::find((int)$id);
        if ($picture->user_id != Auth::id()){
            return redirect()->route('index')->withErrors('Вы не можете удалить эти данные ');
        }
        //Удаляем файлы
        unlink($picture->smallpict);
        unlink($picture->bigpict);

        $picture->tags()->sync([]); //Удаляем записи из связаной таблицы
        $picture->delete();
        return redirect()->route('index')->with('success','');
    }
}
