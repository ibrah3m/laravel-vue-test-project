<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['name','comment_text','parent_id'];
    public function comment_replys()
    {

        return $this->hasMany(Comment::class, 'parent_id');



    }


}
//$method = '->comment_replays[0]';
//$array='$full[]=$query';
//$depth = 3;
//$full = [];
//for ($i = 1; $i <= $depth; $i++) {
//    $array .=$method ;
//    eval($array .";");
//}
//return [
//    'id' => $query->id,
//    'name' => $query->name,
//    'text' => $query->comment_text,
//    'comment_reply'=>$full[0]
//
//];
