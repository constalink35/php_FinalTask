<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public static function store ($requestTags){

        $tagNames = preg_replace('/[^а-яёa-z0-9,]/iu', '', htmlspecialchars(mb_strtolower(trim($requestTags))));
        $tagNames = array_filter(explode(',',$tagNames));
        $tagIds = [];
        foreach($tagNames as $tagName)
        {
            $tag = Tag::firstOrCreate(['name'=>$tagName]);
            if($tag)
            {
                $tagIds[] = $tag->id;
            }
        }
        return  $tagIds;
    }

    public function searchTags(Request $request){

           $referal = trim(strip_tags(stripcslashes(htmlspecialchars($request->referal))));

            $tags = \App\Tag::where('name','like','%'.$referal.'%')->get();

        $output='';
            foreach ($tags as $tag) {

                $output.= '<a href="/tag/'.$tag->id.'" class="dropdown-item" >' .
                        $tag->name . '</a>';
            }

        return Response($output);
        }

}
