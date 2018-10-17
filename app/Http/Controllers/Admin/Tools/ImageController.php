<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/9/24
 * Time: 15:44
 */

namespace App\Http\Controllers\Admin\Tools;



use App\Component\Classes\UploadLoad;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Service\Tools\ToolsService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * 公告上传图片
     * @param Request $request
     * @return array
     */
    public function upload(Request $request){
        $files = $request->file('placard_img');
        $res = [];
        $data = [];
        $errno = 1;
        foreach ($files as $file){
            $path = ToolsService::uploadImage($file,UploadLoad::UP_PLACARD_EDITOR_LOAD);
            if($path){
                $data[] = asset($path);
            }
        }
        if(!empty($data))
            $errno = 0;
        $res['errno'] = $errno;
        $res['data'] = $data;
        return $res;
    }

    /**
     * 文章超文本图片
     * @param Request $request
     * @return array
     */
    public function articleEditorUpload(Request $request){
        $files = $request->file('article_img');
        $res = [];
        $data = [];
        $errno = 1;
        foreach ($files as $file){
            $path = ToolsService::uploadImage($file,UploadLoad::UP_ARTICLE_EDITOR_LOAD);
            if($path){
                $data[] = asset($path);
            }
        }
        if(!empty($data))
            $errno = 0;
        $res['errno'] = $errno;
        $res['data'] = $data;
        return $res;
    }


    /**
     * 博文主题图片 封面
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function articleUpload(Request $request){
        $file = $request->file('file');
        $path = ToolsService::uploadImage($file,UploadLoad::UP_ARTICLE_MAIN_LOAD);
        return $this->setResponse(['path'=>$path])->response();
    }

    /**
     * 删除图片  用于文章封面图片 删除选择上传后并未使用的
     * @param Request $request
     */
    public function unlinkImg(Request $request){
        $path = $request->input('path');
        if($path){
            unlinkImg($path);
        }
    }
}