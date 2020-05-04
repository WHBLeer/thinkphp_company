<?php
namespace app\index\controller;
use app\admin\model\News as NewsModel;
// use app\admin\model\Comment as CommentModel;

class News extends  Common
{
    protected $favicon_url = 'https://api.byi.pw/favicon/';
    /**
     * 博客详情
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-08-08
     * @return   [type]                [description]
     */
    public function index()
    {
        $cateid=input('cateid');

        $newsres=db('news')->field('a.*,b.catename')->alias('a')->join('hatch_cate b','a.cateid=b.id')->where('a.delete_time','NULL')->where('b.id',$cateid)->order('a.id desc')->paginate(12);
        $this->assign('newsres',$newsres);
        $this->assign('cateid',$cateid);
        return view();
    }

    /**
     * 博客详情
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-08-08
     * @return   [type]                [description]
     */
    public function detail()
    {
        $id=input('id');
        db('news')->where('id', $id)->setInc('click');
        $news=db('news')->find($id);
        //使用limit方法查询该栏目的上一篇文章的id值
        // $prev= db('news')->where('id','<',$id)->where('cateid','=',$news['cateid'])->order('id desc')->limit(1)->select();
        //使用limit方法查询该栏目的下一篇文章的id值
        // $next= db('news')->where('id','>',$id)->where('cateid','=',$news['cateid'])->order('id asc')->limit(1)->select();
        // if (empty($prev)) $prev[] = 'no_result';
        // if (empty($next)) $next[] = 'no_result';

        // $this->assign('prev',$prev[0]);
        // $this->assign('next',$next[0]);
        $this->assign('news',$news);
        return $this->fetch();
    }

    // 喜欢
    public function likes()
    {
        $id=input('id');
        db('news')->where('id', $id)->setInc('click');
        $news=db('news')->find($id);
        return json_encode(['data'=>$data,'code'=>200,'message'=>'已点赞！']);
    }

    // 添加评论
    public function comment()
    {
        //获取提交的信息
        $avatar = create_letter_avatar(input('nickname')?:'User');
        $comment = comment_to_html(input('comment'));
        $conf = get_sys_config();
        $status = 0;
        if ($conf['COMMENT_REVIEW']) $status = 1;

        $data=[
            'nickname'  => input('nickname'),
            'email'     => input('email'),
            'url'       => input('url')?:'javascript:void(0);',
            'news'   => input('news')?:0,
            'about'     => input('about')?:0,
            'parent'    => input('parent'),
            'comment'   => $comment,
            'notify'    => input('notify'),
            'status'    => $status,
            'time'      => time(),
            'avatar'    => $avatar,
        ];

        if (input('about')!=0) {
            $newstitle = '关于我';
            $newsurl = SITE_URL . url('index/about/index');
        }else{
            $news = db('news')->find(input('news'));
            $newstitle = $news['title'];
            $newsurl = SITE_URL . url('index/news/detail',array('id'=>$news['id']));
        }

        // 添加到数据库
        if($id = db('comment')->insertGetId($data)){
            $comment =db('comment')->find($id);
            $commentDatas = [
                'ID' => $comment['id'],
                'TIME' => word_time($comment['time']),
                'NICKNAME' => $comment['nickname'],
                'AVATAR' => $comment['avatar'],
                'news' => $comment['news']!=0?:$comment['about'],
                'COMMENT' => $comment['comment'],
                'NOWPAGE' => $comment['id'],
            ];
            if (input('parent')!=0) {
                $parent = db('comment')->find(input('parent'));
                $commentDatas['PARENTNAME'] = $parent['nickname'];
                if ($parent['notify']==1){
                    $mailContent = file_get_contents(MOULD_PATH.DS.'mail-user.tmp');
                    $mailContent = str_replace('###RECEIVER###',$parent['nickname'],$mailContent);
                    $mailContent = str_replace('###newsURL###',$newsurl,$mailContent);
                    $mailContent = str_replace('###newsTITLE###',$newstitle,$mailContent);
                    $mailContent = str_replace('###COMMENTTIME###',date('Y年m月d日 H:i:s'),$mailContent);
                    send_email('评论回复通知',$mailContent, $parent['nickname'], $parent['email']);
                }
            }
            if (!session('rname')) {
                $user=[
                    'nickname'  => $comment['nickname'],
                    'email'     => $comment['email'],
                    'url'       => $comment['url'],
                    'avatar'    => $avatar,
                    'time'      => time(),
                ];
                if($id = db('feuser')->insertGetId($user)){
                    $feuser =db('feuser')->find($id);
                    session('ruid',     $feuser['id']);
                    session('rname',    $feuser['nickname']);
                    session('remail',   $feuser['email']);
                    session('rurl',     $feuser['url']);
                    session('ravatar',  $feuser['avatar']);
                }
            }
            
            
            if ($conf['COMMENT_REVIEW']){
                $mailContent = file_get_contents(MOULD_PATH.DS.'mail-admin.tmp');
                $mailContent = str_replace('###newsURL###',$newsurl,$mailContent);
                $mailContent = str_replace('###newsTITLE###',$newstitle,$mailContent);
                $mailContent = str_replace('###COMMENTTIME###',date('Y年m月d日 H:i:s'),$mailContent);
                send_email('文章评论通知',$mailContent, '管理员', $conf['ADMIN_EMAIL']);
            }

            if (input('parent')>0) {
                $commentContent =file_get_contents(MOULD_PATH.DS.'/comment-children.tmp');
                foreach ($commentDatas as $key => $value) {
                    $commentContent = str_replace('###'.$key.'###', $value, $commentContent);
                }
                return json_encode(array('pid'=> input('parent'),'tt'=>$commentContent));
                // return '<ul class="children">'.$commentContent.'</ul>';
            } else {
                $commentContent = file_get_contents(MOULD_PATH.DS.'/comment-parent.tmp');
                foreach ($commentDatas as $key => $value) {
                    $commentContent = str_replace('###'.$key.'###', $value, $commentContent);
                }
                return $commentContent;
                // return '<ol class="comment-list">'.$commentContent.'</ol>';
            }
            
        }else{
            return json_encode(['code'=>200,'message'=>'评论提交错误！']);
        }
        return;
    }

}
