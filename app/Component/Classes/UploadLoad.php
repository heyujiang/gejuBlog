<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/10/1
 * Time: 23:56
 */

namespace App\Component\Classes;


class UploadLoad
{
    const UPLOAD = [
      self::UP_PLACARD_EDITOR_LOAD      =>      'editor_placard',
      self::UP_ARTICLE_EDITOR_LOAD      =>      'editor_article',
      self::UP_ARTICLE_MAIN_LOAD        =>      'main_article'
    ];

    const UP_PLACARD_EDITOR_LOAD = 1;  //公告富文本插入图片上传路径
    const UP_ARTICLE_EDITOR_LOAD = 2;  //文章富文本插入图片上传路径
    const UP_ARTICLE_MAIN_LOAD = 3; //文章主题图片上传路径
}