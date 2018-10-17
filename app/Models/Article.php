<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'article_id';
    protected $guarded = [];

    /**
     * 是否置顶
     */
    const TOP_STATUS = [
        self::TOP_YES => '是',
        self::TOP_NO => '否'
    ];
    const TOP_YES = 2;
    const TOP_NO = 1;

    /**
     * 是否删除
     */
    const DEL_STATUS = [
        self::DEL_NO => '否',
        self::DEL_YES => '是'
    ];
    const DEL_NO = 1;
    const DEL_YES = 2;

    /**
     * 是否发布
     */
    const RELEASE_STATUS = [
        self::RELEASE_NO => '草稿',
        self::RELEASE_YES=> '发布'
    ];
    const RELEASE_NO = 1;
    const RELEASE_YES = 2;

    /**
     * 是否放在bannel图
     */
    const BANNEL_STATUS = [
        self::BANNEL_NO => '否',
        self::BANNEL_YES=> '是'
    ];
    const BANNEL_NO = 1;
    const BANNEL_YES = 2;

    /**
     * 是否推荐
     */
    const RECOMMEND_STATUS = [
        self::RECOMMEND_NO=> '否',
        self::RECOMMEND_YES=> '是'
    ];
    const RECOMMEND_NO = 1;
    const RECOMMEND_YES = 2;

    /**
     * 博客类别
     */
    const TYPE = [
        self::ORIGINAL => '原创',
        self::REPRINT  => '转载'
    ];
    const ORIGINAL = 1;
    const REPRINT = 2;

    /**
     * 博客类别标签
     */
    const TYPE_TAG = [
        self::ORIGINAL => '原',
        self::REPRINT  => '转'
    ];

    /**
     * 博客类别标签 背景色
     */
    const TYPE_COLOR = [
        self::ORIGINAL => 'red',
        self::REPRINT  => 'orange'
    ];

    /**
     * 文章 - 标签 多对多关联关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag','article_id','tag_id');
    }

    /**
     * 文章 - 分类 一对一 关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    /**
     * 文章 - 用户 一对一 关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
