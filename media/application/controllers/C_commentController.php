<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_commentController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_comment', 'm_comment');
        $this->load->model('M_logPortal', 'm_logPortal');
	}
    
    public function index()
    {
        $where_comment = array(
            'id_article' => $this->input->post('id_article'),
            'id_comment' => '-',
        );

        $list_comment = $this->m_comment->getbyorderby($where_comment, 'created_at', 'DESC');

        $boxComment = '';

        foreach ($list_comment as $comment) {

            // ------ comment --------
        
            $boxComment .= '<div class="card my-2" id="headingReply-'.$comment->id.'" style="background-color: #F3F3F3;" onmouseover="cardOver('.$comment->id.')" onmouseout="cardOut('.$comment->id.')">';
            $boxComment .= '<div class="card-body">';
            $boxComment .= '<p class="card-text">';
            if($comment->name == 'admin') {
                $boxComment .= '<small class="text-muted"><span class="badge badge-secondary">'.$comment->name.'</span></small>';
            }else{
                $boxComment .= '<small class="text-muted">'.$comment->name.'</small>';
            }
            $boxComment .= '<small class="text-muted float-right">'.date("j F Y", strtotime(substr($comment->created_at, 0, 10))).'</small>';
            $boxComment .= '</p>';
            $boxComment .= '<p class="card-text">'.$comment->comment.'</p>';
            $boxComment .= '<div class="float-right">';
            $boxComment .= '<a data-toggle="collapse" data-target="#collapseReply-'.$comment->id.'" aria-expanded="false" aria-controls="collapseReply-'.$comment->id.'"><i class="fa fa-reply icon-message-reply-'.$comment->id.' ml-3" style="color: transparent" aria-hidden="true" title="Reply Message" data-id="'.$comment->id.'"></i></a>';
            $boxComment .= '<i class="fa fa-trash icon-message-delete-'.$comment->id.' ml-3" style="color: transparent" aria-hidden="true" title="Delete Message" data-id="'.$comment->id.'" data-email="'.$comment->email.'"></i>';
            $boxComment .= '</div>';
            $boxComment .= '</div>';
            $boxComment .= '</div>';

            $boxComment .= '<div id="collapseReply-'.$comment->id.'" class="collapse" aria-labelledby="headingReply-'.$comment->id.'" data-parent="#accordionReply">';
            $boxComment .= '<div class="card ml-3 mb-3 px-3 pb-3" style="background-color: #F0F0E1;">';
            $boxComment .= '<div class="card-body pt-3 pb-1 px-0">';
            $boxComment .= '<h6 class="card-title my-1">Balas Komentar</h6>';
            $boxComment .= '</div>';
            $boxComment .= '<hr class="my-1"/>';
            $boxComment .= '<form class="form-comment">';
            $boxComment .= '<div class="row mt-2">';
            // $boxComment .= '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'" />';
            $boxComment .= '<input type="hidden" id="id_article_reply" name="id_article" value="'.$comment->id_article.'">';
            $boxComment .= '<input type="hidden" id="id_comment_reply" name="id_comment" value="'.$comment->id.'">';
            $boxComment .= '<div class="col-12 col-md-6 col-lg-6">';
            $boxComment .= '<div class="form-group">';
            $boxComment .= '<label for="name">Nama</label>';
            if(@$_SESSION['hak_akses'] == 'admin') {
                $boxComment .= '<input type="text" class="form-control" id="name_reply" name="name" placeholder="Nama Anda" value="admin" readonly>';
            }else{
                $boxComment .= '<input type="text" class="form-control" id="name_reply" name="name" placeholder="Nama Anda" maxlength="25" required>';
            }
            $boxComment .= '</div>';
            $boxComment .= '</div>';
            $boxComment .= '<div class="col-12 col-md-6 col-lg-6">';
            $boxComment .= '<div class="form-group">';
            $boxComment .= '<label for="email">Email</label>';
            if(@$_SESSION['hak_akses'] == 'admin') {
                $boxComment .= '<input type="email" class="form-control" id="email_reply" name="email" placeholder="Alamat Email" value="'.$_SESSION['email'].'" readonly>';
            }else{
                $boxComment .= '<input type="email" class="form-control" id="email_reply" name="email" placeholder="Alamat Email" required>';
            }
            $boxComment .= '</div>';
            $boxComment .= '</div>';
            $boxComment .= '</div>';
            $boxComment .= '<div class="row">';
            $boxComment .= '<div class="col-12">';
            $boxComment .= '<div class="form-group">';
            $boxComment .= '<label for="comment">Komentar</label>';
            $boxComment .= '<textarea class="form-control" id="comment_reply" name="comment" rows="3" maxlength="255" required></textarea>';
            $boxComment .= '</div>';
            $boxComment .= '</div>';
            $boxComment .= '</div>';
            $boxComment .= '<button type="submit" class="btn btn-outline-secondary btn-sm float-right btn-comment-submit">Kirim</button>';
            $boxComment .= '<button class="btn btn-outline-warning btn-sm float-right mx-1 btn-comment-batal" data-id="'.$comment->id.'">Batal</button>';
            // $boxComment .= '<button class="btn btn-outline-warning btn-sm float-right mx-1" onclick="batalComment('+value.id+')">Batal</button>';
            $boxComment .= '</form>';
            $boxComment .= '</div>';
            $boxComment .= '</div>';

            // ------ End comment --------

            // ------- reply ----------

            $where_comment_reply = array(
                'id_article' => $this->input->post('id_article'),
                'id_comment' => $comment->id,
            );
    
            $list_comment_reply = $this->m_comment->getbyorderby($where_comment_reply, 'created_at', 'ASC');

            foreach ($list_comment_reply as $comment_reply) {

                $boxComment .= '<div class="card ml-3 my-2" id="headingReply-'.$comment_reply->id.'" style="background-color: #F3F3F3;" onmouseover="cardOver('.$comment_reply->id.')" onmouseout="cardOut('.$comment_reply->id.')">';
                $boxComment .= '<div class="card-body">';
                $boxComment .= '<p class="card-text">';
                if($comment_reply->name == 'admin') {
                    $boxComment .= '<small class="text-muted"><span class="badge badge-secondary">'.$comment_reply->name.'</span></small>';
                }else{
                    $boxComment .= '<small class="text-muted">'.$comment_reply->name.'</small>';
                }
                $boxComment .= '<small class="text-muted float-right">'.date("j F Y", strtotime(substr($comment_reply->created_at, 0, 10))).'</small>';
                $boxComment .= '</p>';
                $boxComment .= '<p class="card-text">'.$comment_reply->comment.'</p>';
                $boxComment .= '<div class="float-right">';
                // $boxComment .= '<a data-toggle="collapse" data-target="#collapseReply-'.$comment_reply->id.'" aria-expanded="false" aria-controls="collapseReply-'.$comment_reply->id.'"><i class="fa fa-reply icon-message-reply ml-3" style="color: transparent" aria-hidden="true" title="Reply Message" data-id="'.$comment_reply->id.'"></i></a>';
                $boxComment .= '<i class="fa fa-trash icon-message-delete-'.$comment_reply->id.' ml-3" style="color: transparent" aria-hidden="true" title="Delete Message" data-id="'.$comment_reply->id.'" data-email="'.$comment_reply->email.'"></i>';
                $boxComment .= '</div>';
                $boxComment .= '</div>';
                $boxComment .= '</div>';

                $boxComment .= '<div id="collapseReply-'.$comment_reply->id.'" class="collapse" aria-labelledby="headingReply-'.$comment_reply->id.'" data-parent="#accordionReply">';
                $boxComment .= '<div class="card ml-3 mb-3 px-3 pb-3" style="background-color: #F0F0E1;">';
                $boxComment .= '<div class="card-body pt-3 pb-1 px-0">';
                $boxComment .= '<h6 class="card-title my-1">Balas Komentar</h6>';
                $boxComment .= '</div>';
                $boxComment .= '<hr class="my-1"/>';
                $boxComment .= '<form class="form-comment">';
                $boxComment .= '<div class="row mt-2">';
                $boxComment .= '<input type="hidden" id="id_article_reply" name="id_article" value="'.$comment_reply->id_article.'">';
                $boxComment .= '<input type="hidden" id="id_comment_reply" name="id_comment" value="'.$comment_reply->id.'">';
                $boxComment .= '<div class="col-12 col-md-6 col-lg-6">';
                $boxComment .= '<div class="form-group">';
                $boxComment .= '<label for="name">Nama</label>';
                $boxComment .= '<input type="text" class="form-control" id="name_reply" name="name" placeholder="Nama Anda" maxlength="25" required>';
                $boxComment .= '</div>';
                $boxComment .= '</div>';
                $boxComment .= '<div class="col-12 col-md-6 col-lg-6">';
                $boxComment .= '<div class="form-group">';
                $boxComment .= '<label for="email">Email</label>';
                $boxComment .= '<input type="email" class="form-control" id="email_reply" name="email" placeholder="Alamat Email" required>';
                $boxComment .= '</div>';
                $boxComment .= '</div>';
                $boxComment .= '</div>';
                $boxComment .= '<div class="row">';
                $boxComment .= '<div class="col-12">';
                $boxComment .= '<div class="form-group">';
                $boxComment .= '<label for="comment">Komentar</label>';
                $boxComment .= '<textarea class="form-control" id="comment_reply" name="comment" rows="3" maxlength="255" required></textarea>';
                $boxComment .= '</div>';
                $boxComment .= '</div>';
                $boxComment .= '</div>';
                $boxComment .= '<button type="submit" class="btn btn-outline-secondary btn-sm float-right btn-comment-submit">Kirim</button>';
                $boxComment .= '<button class="btn btn-outline-warning btn-sm float-right mx-1 btn-comment-batal" data-id="'.$comment_reply->id.'">Batal</button>';
                // $boxComment .= '<button class="btn btn-outline-warning btn-sm float-right mx-1" onclick="batalComment('+value.id+')">Batal</button>';
                $boxComment .= '</form>';
                $boxComment .= '</div>';
                $boxComment .= '</div>';

            }

            // ------- End reply ----------

        }

        echo json_encode($boxComment);
    }

    public function store()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('comment', 'Comment', 'trim|required|max_length[255]');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        }else{
            $item_comment = array(
                'id_article' => $this->input->post('id_article'),
                'id_comment' => $this->input->post('id_comment'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'comment' => $this->input->post('comment'),
            );
            $comment = $this->m_comment->add($item_comment); 
    
            $action = $this->input->post('name').' memberikan komentar article dengan id_article = '.$this->input->post('id_article');
            $ip = $_SERVER['REMOTE_ADDR'];
    
            $getloc = json_decode(file_get_contents("http://ipinfo.io/"));
            $location = $getloc->city;
            
            $item_logPortal = array(
                'action' => $action,
                'location' => $location,
                'ip' => $ip,
            );
            $LogPortal = $this->m_logPortal->add($item_logPortal); 
    
            echo $comment;
        }

    }

    public function destroy()
    {
        // $get_comment = Comment::find($request->id);
        $get_comment = $this->m_comment->getbyid($this->input->post('id'));

        //log
        /* Log::create([
            'page' => 'Article Id= '.$get_comment->id_article,
            'action' => 'delete',
            'description' => 'User email menghapus comment dengan nama user = '.$get_comment->name.' pada id_article = '.$get_comment->id_article,
            'database' => 'comments',
            'author' => 'User Email',
        ]); */

        //logPortal
        $ip = $_SERVER['REMOTE_ADDR'];

        $getloc = json_decode(file_get_contents("http://ipinfo.io/"));
        $location = $getloc->city;
	    
	    $item_logPortal = array(
	            'action' => 'User email menghapus comment dengan nama user = '.$get_comment[0]->name.' pada id_article = '.$get_comment[0]->id_article,
                'location' => $location,
                'ip' => $ip,
	        );
	    $LogPortal = $this->m_logPortal->add($item_logPortal); 

        // $comment = Comment::destroy($request->id);
        $comment = $this->m_comment->delete($this->input->post('id'));

        return $comment;
    }
	
}