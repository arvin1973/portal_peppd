<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pagesController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_guide', 'm_guide');
        $this->load->model('M_article', 'm_article');
        $this->load->model('M_logPortal', 'm_logPortal');

        // $this->load->model();
    }

    public function article_pagination($page_segment)
    {
        // load library pagination
        $this->load->library("pagination");

        //konfigurasi pagination
        $config['base_url'] = site_url(); //site url
        $config['total_rows'] = $this->m_article->count_all(); //total row
        $config['per_page'] = 3; //show record per halaman
        $config["uri_segment"] = 3; // uri parameter
        $config["num_links"] = 1;
        $config["use_page_numbers"] = TRUE;

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span>Next</li>';

        // inisialisasi config ke dalam pagination
        $this->pagination->initialize($config);
        // ambil nilai yg ada di url ke 3
        $page = $this->uri->segment(3);
        // $page = $page_segment;
        // inisialisasi nilai awal untuk database limit
        $start = ($page - 1) * $config["per_page"];
        // panggil fungsi fetch_details di model
        $list_article = $this->m_article->fetch_details($config["per_page"], $start);

        // nilai kosong
        $output = '';
        // melakukan perulangan data artikel untuk di tampilkan dan di tampung pada variable output 
        foreach ($list_article as $article) {
            $output .= '<a data-id="' . $article->id . '" target="_blank" rel="noopener" href="' . base_url() . 'news/' . $article->slug . '"  class="card card-article mb-3">';
            $output .= '<div class="row no-gutters">';
            $output .= '<div class="col-md-5 box-img-news" style="background: url(' . base_url() . 'assets/images/summernote/' . $article->title_picture . '); background-repeat: no-repeat; background-size: contain; background-position: center; background-color: black;">';
            // $output .= '<img class="w-100 img-news" src="' . base_url() . 'assets/images/summernote/' . $article->title_picture . '" alt="' . $article->title . '" />';
            $output .= '</div>';
            $output .= '<div class="col-md-7">';
            $output .= '<div class="card-body">';
            $output .= '<p class="card-text">';
            $output .= '<small class="text-muted">' . date("j F Y", strtotime(substr($article->created_at, 0, 10))) . '</small>';
            $output .= '<span class="badge badge-secondary float-right">' . $article->name . '</span>';
            $output .= '</p>';
            $output .= '<h5 class="card-title title-news">';
            $output .= '<b>' . $article->title . '</b>';
            $output .= '</h5>';
            $output .= '<p class="card-text text-news">';
            $output .= (strlen($article->description) > 105) ? substr($article->description, 0, 101) . '...' : $article->description;
            $output .= '<br/><button type="button" class="button-read-more btn-read-more-article" data-id="' . $article->id . '" target="_blank" rel="noopener" href="' . base_url() . 'news/' . $article->slug . '" title="' . $article->title . '">Selengkapnya...<i class="fa fa-align-left pl-1" aria-hidden="true"></i></button>';
            $output .= '</p>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</a>';
        }
        // foreach ($list_article as $article) {
        //     $output .= '<div class="card mb-3">';
        //     $output .= '<div class="row no-gutters">';
        //     $output .= '<div class="col-md-5 box-img-news" style="background: url(' . base_url() . 'assets/images/summernote/' . $article->title_picture . '); background-repeat: no-repeat; background-size: contain; background-position: center; background-color: black;">';
        //     // $output .= '<img class="w-100 img-news" src="' . base_url() . 'assets/images/summernote/' . $article->title_picture . '" alt="' . $article->title . '" />';
        //     $output .= '</div>';
        //     $output .= '<div class="col-md-7">';
        //     $output .= '<div class="card-body">';
        //     $output .= '<p class="card-text">';
        //     $output .= '<small class="text-muted">' . date("j F Y", strtotime(substr($article->created_at, 0, 10))) . '</small>';
        //     $output .= '<span class="badge badge-secondary float-right">' . $article->name . '</span>';
        //     $output .= '</p>';
        //     $output .= '<h5 class="card-title title-news">';
        //     $output .= '<b>' . $article->title . '</b>';
        //     $output .= '</h5>';
        //     $output .= '<p class="card-text text-news">';
        //     $output .= (strlen($article->description) > 105) ? substr($article->description, 0, 101) . '...' : $article->description;
        //     // $output .= '<i><a class="btn-read-more-article" data-id="'.$article->id.'" target="_blank" rel="noopener" href="'.base_url().'news/'.$article->slug.'" title="'.$article->title.'">selengkapnya</a></i>';
        //     $output .= '<br/><a type="button" class="button-read-more btn-read-more-article" data-id="' . $article->id . '" target="_blank" rel="noopener" href="' . base_url() . 'news/' . $article->slug . '" title="' . $article->title . '">Selengkapnya...<i class="fa fa-align-left pl-1" aria-hidden="true"></i></a>';
        //     $output .= '</p>';
        //     $output .= '</div>';
        //     $output .= '</div>';
        //     $output .= '</div>';
        //     $output .= '</div>';
        // }

        // inisialisasi array
        $list_article_pagination = array(
            'pagination_link' => $this->pagination->create_links(),
            'list_article' => $output
        );

        echo json_encode($list_article_pagination);
    }

    public function home()
    {
        // infografis
        $db2 = $this->load->database('pemantauan', TRUE);
        $data['list_indikator'] = $db2->query("SELECT * FROM `indikator` WHERE ppd=1")->result_array();
        $ind=[];
        foreach($data['list_indikator'] as $indikator){
            if($indikator['id']==1){
                $ind []= $db2->query('SELECT y.*, i.nama_indikator as nm_indikator, i.jenis, i.chart, i.deskripsi FROM (SELECT * FROM nilai_indikator WHERE (id_indikator=? AND wilayah="1000" AND periode="00") AND (id_periode, versi) IN (SELECT id_periode, MAX(versi) AS versi FROM nilai_indikator WHERE id_indikator=? AND wilayah="1000" AND periode="00" GROUP BY id_periode) GROUP BY id_periode ORDER BY id_periode DESC) y JOIN indikator i ON y.id_indikator = i.id ORDER BY y.id_periode DESC',[$indikator['id'],[$indikator['id']]])->result_array();
            }else{
                $ind []= $db2->query('SELECT y.*, i.nama_indikator as nm_indikator, i.jenis, i.chart, i.deskripsi FROM (SELECT * FROM nilai_indikator WHERE (id_indikator=? AND wilayah="1000") AND (id_periode, versi) IN (SELECT id_periode, MAX(versi) AS versi FROM nilai_indikator WHERE id_indikator=? AND wilayah="1000" GROUP BY id_periode) GROUP BY id_periode ORDER BY id_periode DESC) y JOIN indikator i ON y.id_indikator = i.id ORDER BY y.id_periode DESC',[$indikator['id'],[$indikator['id']]])->result_array();
            }
        }
        foreach($ind as &$i){
            if($i[0]['periode']=='00'){
                $i[0]['tahun_periode'] = 'Tahun:'.$i[0]['tahun'];
                $i[1]['tahun_periode'] = 'Tahun:'.$i[1]['tahun'];
            }else{
                $i[0]['tahun_periode'] = 'Tahun(peridode):'.$i[0]['tahun'].'('.$i[0]['periode'].')';
                $i[1]['tahun_periode'] = 'Tahun(peridode):'.$i[1]['tahun'].'('.$i[1]['periode'].')';
            }

            if($i[0]['satuan']=='Rp'){
                $i[0]['nilai_satuan'] = 'Rp'.number_format($i[0]['nilai']/1000000,2,'.',',').' Juta';
                $i[1]['nilai_satuan'] = 'Rp'.number_format($i[1]['nilai']/1000000,2,'.',',').' Juta';
            }elseif($i[0]['satuan']=='%'){
                $i[0]['nilai_satuan'] = number_format($i[0]['nilai'],2).' %';
                $i[1]['nilai_satuan'] = number_format($i[1]['nilai'],2).' %';
            }elseif($i[0]['satuan']=='Orang'){
                $i[0]['nilai_satuan'] = number_format($i[0]['nilai']/100000,2,'.',',').' Juta Orang';
                $i[1]['nilai_satuan'] = number_format($i[1]['nilai']/100000,2,'.',',').' Juta Orang';
            }elseif($i[0]['satuan']=='Tahun'){
                $i[0]['nilai_satuan'] = number_format($i[0]['nilai'],2).' Tahun';
                $i[1]['nilai_satuan'] = number_format($i[1]['nilai'],2).' Tahun';
            }else{
                $i[0]['nilai_satuan'] = number_format($i[0]['nilai'],2);
                $i[1]['nilai_satuan'] = number_format($i[1]['nilai'],2);
            }
        }
        unset($i);
//         echo '<pre>';
// var_dump($ind);
// echo '</pre>';
        $data['indikator'] = $ind;

        // --------------------------------------------------------------------------------------------------
        $data['list_publications'] = $this->m_guide->getallorderbydesc();

        $data['list_pub'] = array();
        foreach ($data['list_publications'] as $l_pub) {
            $item_publication = $this->m_guide->allandpagehintdownload('user menklik dokumen/file dengan id = ' . $l_pub->id . '%', 'user mengunduh dokumen/file dengan id = ' . $l_pub->id . '%', $l_pub->id);
            array_push($data['list_pub'], $item_publication);
        }

        /* $where_article = array(
                  'status' => 'publish',
              );
              $data['articles'] = $this->m_article->getby($where_article); */
        $data['articles'] = $this->m_article->joinCategorieswhere1('status', 'publish');
        // $data['articles'] = $this->m_article->joinCategorieswhere1limit('status', 'publish', '3');

        $category = $this->m_article->selectdistinctorderbydesc('id_category', 'created_at', 'DESC');

        for ($i = 0; $i < count($category); $i++) {
            $data['carousel_content'][$i] = $this->m_article->joinCategorieswhere2limit('status', 'publish', 'id_category', $category[$i]->id_category, '1');
        }

        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_home', $data);
        $this->load->view('pages/include/V_footer');
    }

    public function news($slug = '')
    {
        if ($slug == '') {
            /* $where_article = array(
                         'status' => 'publish',
                     );
                     $data['articles'] = $this->m_article->getby($where_article); */
            $data['articles'] = $this->m_article->joinCategorieswhere1('status', 'publish');

            $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
            $nav['last_guide'] = $this->m_guide->getallorderbydesc();

            $this->load->view('pages/include/V_header', $nav);
            $this->load->view('pages/main/V_article_publication', $data);
            $this->load->view('pages/include/V_footer');
        } else {
            /* $where_article = array(
                         'slug' => $slug,

                     );
                     $data['article'] = $this->m_article->getby($where_article); */
            $data['article'] = $this->m_article->joinCategorieswhere1('articles.slug', $slug);

            $where_page_hint = array(
                'action' => 'user mengklik article dengan id = ' . $data['article'][0]->id . ' '
            );
            $data['page_hint'] = $this->m_logPortal->likeby($where_page_hint);

            // linked article
            $sum_article_before = $this->m_article->article_before($data['article'][0]->id_category, $data['article'][0]->created_at);
            $sum_article_after = $this->m_article->article_after($data['article'][0]->id_category, $data['article'][0]->created_at);

            if ((count($sum_article_after) >= 2) && (count($sum_article_before) >= 2)) {
                $data['article_before'] = $this->m_article->article_before_limit($data['article'][0]->id_category, $data['article'][0]->created_at, 2);
                $data['article_after'] = $this->m_article->article_after_limit($data['article'][0]->id_category, $data['article'][0]->created_at, 2);
            } else if ((count($sum_article_after) >= 2) && (count($sum_article_before) < 2)) {
                $data['article_before'] = $this->m_article->article_before_limit($data['article'][0]->id_category, $data['article'][0]->created_at, count($sum_article_before));
                $data['article_after'] = $this->m_article->article_after_limit($data['article'][0]->id_category, $data['article'][0]->created_at, 4 - count($sum_article_before));
            } else if ((count($sum_article_after) < 2) && (count($sum_article_before) >= 2)) {
                $data['article_before'] = $this->m_article->article_before_limit($data['article'][0]->id_category, $data['article'][0]->created_at, 4 - count($sum_article_after));
                $data['article_after'] = $this->m_article->article_after_limit($data['article'][0]->id_category, $data['article'][0]->created_at, count($sum_article_after));
            } else if ((count($sum_article_after) < 2) && (count($sum_article_before) < 2)) {
                $data['article_before'] = $this->m_article->article_before_limit($data['article'][0]->id_category, $data['article'][0]->created_at, count($sum_article_before));
                $data['article_after'] = $this->m_article->article_after_limit($data['article'][0]->id_category, $data['article'][0]->created_at, count($sum_article_after));
            } else {
                $data['article_before'] = '';
                $data['article_after'] = '';
            }
            // end linked article

            $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
            $nav['last_guide'] = $this->m_guide->getallorderbydesc();

            $this->load->view('pages/include/V_header', $nav);
            $this->load->view('pages/main/V_article', $data);
            $this->load->view('pages/include/V_footer');
        }
    }

    public function publication()
    {
        $data['list_publications'] = $this->m_guide->getallorderbydesc();

        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_publication', $data);
        $this->load->view('pages/include/V_footer');
    }

    public function file_publication($folder, $title)
    {
        $data['folder'] = $folder;
        $data['title'] = $title;
        $this->load->view('pages/main/V_file_publication', $data);
    }

    public function aplikasi()
    {
        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_aplikasi');
        $this->load->view('pages/include/V_footer');
    }

    public function getFilteredData()
    {
        $db2 = $this->load->database('pemantauan', TRUE);

        if ($this->input->is_ajax_request()) {
            $selectedValue = $this->input->post('selectedValue');

            $kodeSubWilayah = $this->encryption->decrypt($selectedValue);

            // Query the database to fetch data based on the selected value
            $query = $db2->query("SELECT * FROM kabupaten WHERE prov_id='$kodeSubWilayah'");
            $filteredData = $query->result_array();
            foreach ($filteredData as &$kabkot) {
                $id = $kabkot['id'];
                $newId = $this->encryption->encrypt($id);
                $kabkot['id'] = $newId;
            }

            // Return the filtered data as JSON
            echo json_encode($filteredData);
        } else {
            echo json_encode(['error' => 'Invalid request']);
        }
    }


    public function test()
    {
        $this->load->model('M_description_indicator', 'm_description_indicator');

        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $db2 = $this->load->database('pemantauan', TRUE);

        $data['list_indikator'] = $db2->query("SELECT * FROM indikator")->result_array();
        $data['list_provinsi'] = $db2->query("SELECT * FROM provinsi")->result_array();
        $data['list_kab_kot'] = $db2->query("SELECT * FROM kabupaten")->result_array();

        // //encrypt
        foreach ($data['list_provinsi'] as &$provinsi) {
            $id = $provinsi['id'];
            $newId = $this->encryption->encrypt($id);
            $provinsi['id'] = $newId;
        }
        $json_list_provinsi = json_encode($data['list_provinsi']);
        $json_list_kab_kot = json_encode($data['list_kab_kot']);


        $data['json_list_provinsi'] = $json_list_provinsi;
        $data['json_list_kab_kot'] = $json_list_kab_kot;


        $data['IndikatorTable'] = null;
        $data['wilayah'] = null;

        $indikator = strtolower(str_replace("_", " ", $this->input->post('indikator', TRUE)));

        if ($indikator) {
            $data['indikator'] = strtolower(str_replace("_", " ", $indikator));
            $query = "'SELECT * FROM indikator WHERE nama_indikator = ?', $indikator";
            $data['IndikatorTable'] = $db2->query("SELECT * FROM indikator WHERE nama_indikator = ?", [$indikator])->result_array();
        }


        $wilayah = $this->input->post('wilayah', TRUE);
        $kodeSubWilayah = $this->input->post('subWilayah', TRUE);

        if ($kodeSubWilayah) {
            $kodeSubWilayah = $this->encryption->decrypt($kodeSubWilayah);
            if ($kodeSubWilayah === false) {
                redirect('test/404');
            }
        }

        if ($wilayah) {

            $data['wilayah'] = strtolower($wilayah);
        }

        if ($kodeSubWilayah) {
            $data['subWilayah'] = $db2->query("SELECT * FROM provinsi WHERE id = ?", [$kodeSubWilayah])->result_array();
        }

        $kodeKabupatenKota = null;
        $kodeKabupatenKota = $this->input->post('kabupatenkota');
        $data['kodeKabupatenKota'] = $kodeKabupatenKota;
        if ($kodeKabupatenKota) {
            $kodeKabupatenKota = $this->encryption->decrypt($kodeKabupatenKota);
            if ($kodeKabupatenKota === false) {
                redirect('test/404');
            }
        }
        if ($kodeKabupatenKota) {
            $data['subWilayahDaerah'] = $db2->query("SELECT * FROM kabupaten WHERE id = ?", [$kodeKabupatenKota])->result_array();
        }

        switch ($data['wilayah']) {
            case 'nasional':
                $data['infographnasional'] = $db2->query("SELECT * FROM (SELECT * FROM nilai_indikator WHERE (id_indikator=? AND wilayah='1000') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator=? AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC", [$data['IndikatorTable'][0]['id'], $data['IndikatorTable'][0]['id']])->result_array();
                break;

            case 'provinsi':
                $data['infographprovinsi'] = $db2->query("SELECT * FROM (SELECT * FROM nilai_indikator WHERE (id_indikator=? AND wilayah=?) AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator=? AND wilayah=? group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC", [$data['IndikatorTable'][0]['id'], $kodeSubWilayah, $data['IndikatorTable'][0]['id'], $kodeSubWilayah])->result_array();
                if (isset($data['infographprovinsi'][5])) {
                    $data['graphperbandinganwilayah'] = $db2->query("SELECT p.label AS label, p.nama_provinsi AS nama_daerah, e.* FROM provinsi p JOIN nilai_indikator e ON p.id = e.wilayah WHERE (e.id_indikator=? AND e.id_periode=?) AND periode != '01' AND (wilayah, versi) IN (SELECT x.wilayah, max(x.versi) AS versi FROM nilai_indikator x WHERE id_indikator=? AND id_periode=? GROUP BY wilayah) GROUP BY wilayah ORDER BY wilayah ASC", [$data['IndikatorTable'][0]['id'], $data['infographprovinsi'][5]['id_periode'], $data['IndikatorTable'][0]['id'], $data['infographprovinsi'][5]['id_periode']])->result_array();
                }
                break;

            case 'kabupatenkota':
                $sql_nilai_indikator = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator=? AND wilayah='1000') AND periode !='01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator=? AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC", [$data['IndikatorTable'][0]['id'], $data['IndikatorTable'][0]['id']])->result();
                foreach ($sql_nilai_indikator as $row_sql) {
                    $idperiode[] = $row_sql->id_periode;
                }
                $periode_kab_max = max($idperiode);
                $data['graphperbandinganwilayah'] = $db2->query("select p.nama_kabupaten as label, p.nama_kabupaten as nama_daerah, e.* from kabupaten p join nilai_indikator e on p.id = e.wilayah where p.prov_id=? and (e.id_indikator=? AND e.id_periode=?) AND periode != '01' AND (wilayah, versi) in (select x.wilayah, max(x.versi) as versi from nilai_indikator x  where id_indikator=? AND id_periode=? group by wilayah ) group by wilayah order by wilayah asc", [$kodeSubWilayah, $data['IndikatorTable'][0]['id'], $periode_kab_max, $data['IndikatorTable'][0]['id'], $periode_kab_max])->result_array();
                $data['infographprovinsi'] = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator=? AND wilayah=?) AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator=? AND wilayah=? group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC", [$data['IndikatorTable'][0]['id'], $kodeSubWilayah, $data['IndikatorTable'][0]['id'], $kodeSubWilayah])->result_array();
                $data['infographkabupatenkota'] = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator=? AND wilayah=?) AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator=? AND wilayah=? group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC", [$data['IndikatorTable'][0]['id'], $kodeKabupatenKota, $data['IndikatorTable'][0]['id'], $kodeKabupatenKota])->result_array();
                break;

            default:
                $data['infograph'] = 'Wilayah belum diisi';
                break;
        }

        $where_description_indicator = array(
            'id_indikator' => @$data['IndikatorTable'][0]['id'],
            'wilayah' => $data['wilayah'],
            'keterangan' => 'Deskripsi 1',
        );
        $data['description'] = $this->m_description_indicator->getby($where_description_indicator);


        if ($data['description'] != null) {
            //deskripsi indikator
            setlocale(LC_TIME, 'id_ID', 'Indonesian_indonesia', 'Indonesian');
            if ($data['wilayah'] == 'nasional') {

                $db2 = $this->load->database('pemantauan', TRUE);

                //nama indikator
                $indikatorTable = $db2->query("SELECT * FROM indikator WHERE id = '" . $data['IndikatorTable'][0]['id'] . "'")->result_array();



                $infographnasional = $db2->query("SELECT * FROM (SELECT * FROM nilai_indikator WHERE (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

                if ($infographnasional[4]['nasional'] >= $infographnasional[5]['nasional']) {
                    $status_capaian = '<b>di bawah</b>';
                } elseif ($infographnasional[4]['nasional'] <= $infographnasional[5]['nasional']) {
                    $status_capaian = '<b>di atas</b>';
                } elseif ($infographnasional[4]['nasional'] == $infographnasional[5]['nasional']) {
                    $status_capaian = '<b>sama dengan</b>';
                } else {
                    $status_capaian = '<b>unknown</b>';
                }

                if ($infographnasional[5]['satuan'] == '%') {
                    $nilainasional5 = round($infographnasional[5]['nasional'], 2) . '' . $infographnasional[5]['satuan'];
                } elseif ($infographnasional[5]['satuan'] == 'Rp') {
                    $nilainasional5 = $infographnasional[5]['satuan'] . ' ' . number_format($infographnasional[5]['nasional'], 0, ',', '.');
                } elseif ($infographnasional[5]['satuan'] == 'Orang') {
                    $nilainasional5 = number_format($infographnasional[5]['nasional'], 0, ',', '.') . ' ' . $infographnasional[5]['satuan'];
                } elseif ($infographnasional[5]['satuan'] == 'Tahun') {
                    $nilainasional5 = number_format($infographnasional[5]['nasional'], 2, ',', '.') . ' ' . $infographnasional[5]['satuan'];
                } else {
                    $nilainasional5 = $infographnasional[5]['nasional'];
                }


                $change_indicator_name = str_replace("[nama indikator]", $indikatorTable[0]['nama_indikator'], $data['description'][0]->deskripsi);

                $this_month_year = strftime("%B", mktime(0, 0, 0, $infographnasional[5]['periode'])) . " " . $infographnasional[5]['tahun'];
                $change_this_month_year = str_replace("[bulan - tahun ini]", $this_month_year, $change_indicator_name);

                $change_status_capaian = str_replace("[sparator tahun ini dengan tahun sebelumnya]", $status_capaian, $change_this_month_year);

                $previous_month_year = strftime("%B", mktime(0, 0, 0, $infographnasional[4]['periode'])) . " " . $infographnasional[4]['tahun'];
                $change_previous_month_year = str_replace("[bulan - 1 tahun lalu]", $previous_month_year, $change_status_capaian);

                $change_nilai = str_replace("[nilai saat ini]", $nilainasional5, $change_previous_month_year);

                $data['deskripsi_indikator'] = $change_nilai;
            } elseif ($data['wilayah'] == 'provinsi') {

                $db2 = $this->load->database('pemantauan', TRUE);

                //nama indikator
                $indikatorTable = $db2->query("SELECT * FROM indikator WHERE id = '" . $data['IndikatorTable'][0]['id'] . "'")->result_array();

                $infographprovinsi = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

                $subWilayah = $db2->query("SELECT * FROM provinsi WHERE id ='" . $kodeSubWilayah . "'")->result_array();

                if ($infographprovinsi[4]['nilai'] >= $infographprovinsi[5]['nilai']) {
                    $status_capaian = '<b>di bawah</b>';
                } elseif ($infographprovinsi[4]['nilai'] <= $infographprovinsi[5]['nilai']) {
                    $status_capaian = '<b>di atas</b>';
                } elseif ($infographprovinsi[4]['nilai'] == $infographprovinsi[5]['nilai']) {
                    $status_capaian = '<b>sama dengan</b>';
                } else {
                    $status_capaian = '<b>unknown</b>';
                }


                if ($infographprovinsi[5]['satuan'] == '%') {
                    $nilaiprovinsi4 = round($infographprovinsi[4]['nilai'], 2) . '' . $infographprovinsi[4]['satuan'];
                    $nilaiprovinsi5 = round($infographprovinsi[5]['nilai'], 2) . '' . $infographprovinsi[5]['satuan'];
                } elseif ($infographprovinsi[5]['satuan'] == 'Rp') {
                    $nilaiprovinsi4 = $infographprovinsi[4]['satuan'] . ' ' . number_format($infographprovinsi[4]['nilai'], 0, ',', '.');
                    $nilaiprovinsi5 = $infographprovinsi[5]['satuan'] . ' ' . number_format($infographprovinsi[5]['nilai'], 0, ',', '.');
                } elseif ($infographprovinsi[5]['satuan'] == 'Orang') {
                    $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 0, ',', '.') . ' ' . $infographprovinsi[4]['satuan'];
                    $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 0, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                } elseif ($infographprovinsi[5]['satuan'] == 'Tahun') {
                    $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 2, ',', '.') . ' ' . $infographprovinsi[4]['satuan'];
                    $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 2, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                } else {
                    $nilaiprovinsi4 = $infographprovinsi[4]['nilai'];
                    $nilaiprovinsi5 = $infographprovinsi[5]['nilai'];
                }

                $change_indicator_name = str_replace("[nama indikator]", $indikatorTable[0]['nama_indikator'], $data['description'][0]->deskripsi);

                $change_province = str_replace("[nama daerah]", $subWilayah[0]['nama_provinsi'], $change_indicator_name);

                $this_month_year = strftime("%B", mktime(0, 0, 0, $infographprovinsi[5]['periode'])) . " " . $infographprovinsi[5]['tahun'];
                $change_this_month_year = str_replace("[bulan - tahun ini]", $this_month_year, $change_province);

                $change_status_capaian = str_replace("[sparator tahun ini dengan tahun sebelumnya]", $status_capaian, $change_this_month_year);

                $previous_month_year = strftime("%B", mktime(0, 0, 0, $infographprovinsi[4]['periode'])) . " " . $infographprovinsi[4]['tahun'];
                $change_previous_month_year = str_replace("[bulan - 1 tahun lalu]", $previous_month_year, $change_status_capaian);

                $change_nilai = str_replace("[nilai saat ini]", $nilaiprovinsi5, $change_previous_month_year);

                $change_nilai_2 = str_replace("[nilai 1 tahun sebelumnya]", $nilaiprovinsi4, $change_nilai);

                $data['deskripsi_indikator'] = $change_nilai_2;
            } elseif ($data['wilayah'] == 'kabupatenkota') {

                $db2 = $this->load->database('pemantauan', TRUE);

                //nama indikator
                $indikatorTable = $db2->query("SELECT * FROM indikator WHERE id = '" . $data['IndikatorTable'][0]['id'] . "'")->result_array();

                $infographkabupatenkota = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

                $subWilayah = $db2->query("SELECT * FROM kabupaten WHERE id ='" . $kodeKabupatenKota . "'")->result_array();

                if ($infographkabupatenkota[4]['nilai'] >= $infographkabupatenkota[5]['nilai']) {
                    $status_capaian = '<b>di bawah</b>';
                } elseif ($infographkabupatenkota[4]['nilai'] <= $infographkabupatenkota[5]['nilai']) {
                    $status_capaian = '<b>di atas</b>';
                } elseif ($infographkabupatenkota[4]['nilai'] == $infographkabupatenkota[5]['nilai']) {
                    $status_capaian = '<b>sama dengan</b>';
                } else {
                    $status_capaian = '<b>unknown</b>';
                }

                if ($infographkabupatenkota[5]['satuan'] == '%') {
                    $nilaikabupatenkota4 = round($infographkabupatenkota[4]['nilai'], 2) . '' . $infographkabupatenkota[4]['satuan'];
                    $nilaikabupatenkota5 = round($infographkabupatenkota[5]['nilai'], 2) . '' . $infographkabupatenkota[5]['satuan'];
                } elseif ($infographkabupatenkota[5]['satuan'] == 'Rp') {
                    $nilaikabupatenkota4 = $infographkabupatenkota[4]['satuan'] . ' ' . number_format($infographkabupatenkota[4]['nilai'], 0, ',', '.');
                    $nilaikabupatenkota5 = $infographkabupatenkota[5]['satuan'] . ' ' . number_format($infographkabupatenkota[5]['nilai'], 0, ',', '.');
                } elseif ($infographkabupatenkota[5]['satuan'] == 'Orang') {
                    $nilaikabupatenkota4 = number_format($infographkabupatenkota[4]['nilai'], 0, ',', '.') . ' ' . $infographkabupatenkota[4]['satuan'];
                    $nilaikabupatenkota5 = number_format($infographkabupatenkota[5]['nilai'], 0, ',', '.') . ' ' . $infographkabupatenkota[5]['satuan'];
                } elseif ($infographkabupatenkota[5]['satuan'] == 'Tahun') {
                    $nilaikabupatenkota4 = number_format($infographkabupatenkota[4]['nilai'], 2, ',', '.') . ' ' . $infographkabupatenkota[4]['satuan'];
                    $nilaikabupatenkota5 = number_format($infographkabupatenkota[5]['nilai'], 2, ',', '.') . ' ' . $infographkabupatenkota[5]['satuan'];
                } else {
                    $nilaikabupatenkota4 = $infographkabupatenkota[4]['nilai'];
                    $nilaikabupatenkota5 = $infographkabupatenkota[5]['nilai'];
                }

                $change_indicator_name = str_replace("[nama indikator]", $indikatorTable[0]['nama_indikator'], $data['description'][0]->deskripsi);

                $change_region = str_replace("[nama daerah]", $subWilayah[0]['nama_kabupaten'], $change_indicator_name);

                $this_month_year = strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[5]['periode'])) . " " . $infographkabupatenkota[5]['tahun'];
                $change_this_month_year = str_replace("[bulan - tahun ini]", $this_month_year, $change_region);

                $change_status_capaian = str_replace("[sparator tahun ini dengan tahun sebelumnya]", $status_capaian, $change_this_month_year);

                $previous_month_year = strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[4]['periode'])) . " " . $infographkabupatenkota[4]['tahun'];
                $change_previous_month_year = str_replace("[bulan - 1 tahun lalu]", $previous_month_year, $change_status_capaian);

                $change_nilai = str_replace("[nilai saat ini]", $nilaikabupatenkota5, $change_previous_month_year);

                $change_nilai_2 = str_replace("[nilai 1 tahun sebelumnya]", $nilaikabupatenkota4, $change_nilai);

                $data['deskripsi_indikator'] = $change_nilai_2;
            }
        } else {
            $data['deskripsi_indikator'] = '';
        }
        //end deskripsi 1

        //deskripsi 2
        $where_description_indicator_2 = array(
            'id_indikator' => @$data['IndikatorTable'][0]['id'],
            'wilayah' => $data['wilayah'],
            'keterangan' => 'Deskripsi 2',
        );
        $data['description2'] = $this->m_description_indicator->getby($where_description_indicator_2);

        if ($data['description2'] != null) {
            //deskripsi indikator
            setlocale(LC_TIME, 'id_ID', 'Indonesian_indonesia', 'Indonesian');
            if ($data['wilayah'] == 'nasional') {

                $db2 = $this->load->database('pemantauan', TRUE);

                //nama indikator
                $indikatorTable = $db2->query("SELECT * FROM indikator WHERE id = '" . $data['IndikatorTable'][0]['id'] . "'")->result_array();

                $infographnasional = $db2->query("SELECT * FROM (SELECT * FROM nilai_indikator WHERE (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

                //sparator deskripsi 1
                if ($infographnasional[4]['nasional'] >= $infographnasional[5]['nasional']) {
                    $status_capaian = '<b>di bawah</b>';
                } elseif ($infographnasional[4]['nasional'] <= $infographnasional[5]['nasional']) {
                    $status_capaian = '<b>di atas</b>';
                } elseif ($infographnasional[4]['nasional'] == $infographnasional[5]['nasional']) {
                    $status_capaian = '<b>sama dengan</b>';
                } else {
                    $status_capaian = '<b>unknown</b>';
                }
                //end sparator deskripsi 1

                //sparator deskripsi 2
                if ($infographnasional[5]['nasional'] >= $infographnasional[5]['nilai']) {
                    $status_capaian_indikator = '<b>di bawah</b>';
                } elseif ($infographnasional[5]['nasional'] <= $infographnasional[5]['nilai']) {
                    $status_capaian_indikator = '<b>di atas</b>';
                } elseif ($infographnasional[5]['nasional'] == $infographnasional[5]['nilai']) {
                    $status_capaian_indikator = '<b>sama dengan</b>';
                } else {
                    $status_capaian_indikator = '<b>unknown</b>';
                }
                //end sparator deskripsi 2

                //nilai deskripsi 1
                if ($infographnasional[5]['satuan'] == '%') {
                    $nilainasional5 = round($infographnasional[5]['nasional'], 2) . '' . $infographnasional[5]['satuan'];
                } elseif ($infographnasional[5]['satuan'] == 'Rp') {
                    $nilainasional5 = $infographnasional[5]['satuan'] . ' ' . number_format($infographnasional[5]['nasional'], 0, ',', '.');
                } elseif ($infographnasional[5]['satuan'] == 'Orang') {
                    $nilainasional5 = number_format($infographnasional[5]['nasional'], 0, ',', '.') . ' ' . $infographnasional[5]['satuan'];
                } elseif ($infographnasional[5]['satuan'] == 'Tahun') {
                    $nilainasional5 = number_format($infographnasional[5]['nasional'], 2, ',', '.') . ' ' . $infographnasional[5]['satuan'];
                } else {
                    $nilainasional5 = $infographnasional[5]['nasional'];
                }
                //end nilai deskripsi 1

                $change_indicator_name = str_replace("[nama indikator]", $indikatorTable[0]['nama_indikator'], $data['description2'][0]->deskripsi);

                $this_month_year = strftime("%B", mktime(0, 0, 0, $infographnasional[5]['periode'])) . " " . $infographnasional[5]['tahun'];
                $change_this_month_year = str_replace("[bulan - tahun ini]", $this_month_year, $change_indicator_name);

                $change_status_capaian = str_replace("[sparator tahun ini dengan tahun sebelumnya]", $status_capaian, $change_this_month_year);

                $previous_month_year = strftime("%B", mktime(0, 0, 0, $infographnasional[4]['periode'])) . " " . $infographnasional[4]['tahun'];
                $change_previous_month_year = str_replace("[bulan - 1 tahun lalu]", $previous_month_year, $change_status_capaian);

                $change_nilai = str_replace("[nilai saat ini]", $nilainasional5, $change_previous_month_year);

                $data['deskripsi_indikator2'] = $change_nilai;
            } elseif ($data['wilayah'] == 'provinsi') {

                $db2 = $this->load->database('pemantauan', TRUE);

                //nama indikator
                $indikatorTable = $db2->query("SELECT * FROM indikator WHERE id = '" . $data['IndikatorTable'][0]['id'] . "'")->result_array();

                $infographprovinsi = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

                $subWilayah = $db2->query("SELECT * FROM provinsi WHERE id ='" . $kodeSubWilayah . "'")->result_array();

                //sparator deskripsi 1
                if ($infographprovinsi[4]['nilai'] >= $infographprovinsi[5]['nilai']) {
                    $status_capaian = '<b>di bawah</b>';
                } elseif ($infographprovinsi[4]['nilai'] <= $infographprovinsi[5]['nilai']) {
                    $status_capaian = '<b>di atas</b>';
                } elseif ($infographprovinsi[4]['nilai'] == $infographprovinsi[5]['nilai']) {
                    $status_capaian = '<b>sama dengan</b>';
                } else {
                    $status_capaian = '<b>unknown</b>';
                }
                //end sparator deskripsi 1

                //sparator deskripsi 2
                if ($infographprovinsi[5]['nasional'] >= $infographprovinsi[5]['nilai']) {
                    $status_capaian_indikator = '<b>di bawah</b>';
                } elseif ($infographprovinsi[5]['nasional'] <= $infographprovinsi[5]['nilai']) {
                    $status_capaian_indikator = '<b>di atas</b>';
                } elseif ($infographprovinsi[5]['nasional'] == $infographprovinsi[5]['nilai']) {
                    $status_capaian_indikator = '<b>sama dengan</b>';
                } else {
                    $status_capaian_indikator = '<b>unknown</b>';
                }
                //end sparator deskripsi 2

                //nilai deskripsi 1
                if ($infographprovinsi[5]['satuan'] == '%') {
                    $nilaiprovinsi4 = round($infographprovinsi[4]['nilai'], 2) . '' . $infographprovinsi[4]['satuan'];
                    $nilaiprovinsi5 = round($infographprovinsi[5]['nilai'], 2) . '' . $infographprovinsi[5]['satuan'];
                } elseif ($infographprovinsi[5]['satuan'] == 'Rp') {
                    $nilaiprovinsi4 = $infographprovinsi[4]['satuan'] . ' ' . number_format($infographprovinsi[4]['nilai'], 0, ',', '.');
                    $nilaiprovinsi5 = $infographprovinsi[5]['satuan'] . ' ' . number_format($infographprovinsi[5]['nilai'], 0, ',', '.');
                } elseif ($infographprovinsi[5]['satuan'] == 'Orang') {
                    $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 0, ',', '.') . ' ' . $infographprovinsi[4]['satuan'];
                    $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 0, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                } elseif ($infographprovinsi[5]['satuan'] == 'Tahun') {
                    $nilaiprovinsi4 = number_format($infographprovinsi[4]['nilai'], 2, ',', '.') . ' ' . $infographprovinsi[4]['satuan'];
                    $nilaiprovinsi5 = number_format($infographprovinsi[5]['nilai'], 2, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                } else {
                    $nilaiprovinsi4 = $infographprovinsi[4]['nilai'];
                    $nilaiprovinsi5 = $infographprovinsi[5]['nilai'];
                }
                //end nilai deskripsi 1

                //nilai nasional dan provinsi deskripsi 2
                if ($infographprovinsi[5]['satuan'] == '%') {
                    $nilaiprovinsi = round($infographprovinsi[5]['nilai'], 2) . '' . $infographprovinsi[5]['satuan'];
                    $nilainasional = round($infographprovinsi[5]['nasional'], 2) . '' . $infographprovinsi[5]['satuan'];
                } elseif ($infographprovinsi[5]['satuan'] == 'Rp') {
                    $nilaiprovinsi = $infographprovinsi[5]['satuan'] . ' ' . number_format($infographprovinsi[5]['nilai'], 0, ',', '.');
                    $nilainasional = $infographprovinsi[5]['satuan'] . ' ' . number_format($infographprovinsi[5]['nasional'], 0, ',', '.');
                } elseif ($infographprovinsi[5]['satuan'] == 'Orang') {
                    $nilaiprovinsi = number_format($infographprovinsi[5]['nilai'], 0, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                    $nilainasional = number_format($infographprovinsi[5]['nasional'], 0, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                } elseif ($infographprovinsi[5]['satuan'] == 'Tahun') {
                    $nilaiprovinsi = number_format($infographprovinsi[5]['nilai'], 2, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                    $nilainasional = number_format($infographprovinsi[5]['nasional'], 2, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                } else {
                    $nilaiprovinsi = $infographprovinsi[5]['nilai'];
                    $nilainasional = $infographprovinsi[5]['nasional'];
                }
                //nilai nasional dan provinsi deskripsi 2

                $change_indicator_name = str_replace("[nama indikator]", $indikatorTable[0]['nama_indikator'], $data['description2'][0]->deskripsi);

                $change_province = str_replace("[nama daerah]", $subWilayah[0]['nama_provinsi'], $change_indicator_name);

                $this_month_year = strftime("%B", mktime(0, 0, 0, $infographprovinsi[5]['periode'])) . " " . $infographprovinsi[5]['tahun'];
                $change_this_month_year = str_replace("[bulan - tahun ini]", $this_month_year, $change_province);

                $change_status_capaian = str_replace("[sparator tahun ini dengan tahun sebelumnya]", $status_capaian, $change_this_month_year);

                $previous_month_year = strftime("%B", mktime(0, 0, 0, $infographprovinsi[4]['periode'])) . " " . $infographprovinsi[4]['tahun'];
                $change_previous_month_year = str_replace("[bulan - 1 tahun lalu]", $previous_month_year, $change_status_capaian);

                $change_nilai = str_replace("[nilai saat ini]", $nilaiprovinsi5, $change_previous_month_year);

                $change_nilai_2 = str_replace("[nilai 1 tahun sebelumnya]", $nilaiprovinsi4, $change_nilai);

                $change_status_capaian_indikator = str_replace("[sparator nilai daerah dengan nilai nasional]", $status_capaian_indikator, $change_nilai_2);

                $change_nilai_daerah = str_replace("[nilai daerah saat ini]", $nilaiprovinsi, $change_status_capaian_indikator);

                $change_nilai_nasional = str_replace("[nilai nasional saat ini]", $nilainasional, $change_nilai_daerah);

                $data['deskripsi_indikator2'] = $change_nilai_nasional;
            } elseif ($data['wilayah'] == 'kabupatenkota') {

                $db2 = $this->load->database('pemantauan', TRUE);

                //nama indikator
                $indikatorTable = $db2->query("SELECT * FROM indikator WHERE id = '" . $data['IndikatorTable'][0]['id'] . "'")->result_array();

                $infographprovinsi = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

                $infographkabupatenkota = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

                $subWilayah = $db2->query("SELECT * FROM kabupaten WHERE id ='" . $kodeKabupatenKota . "'")->result_array();

                //sparator deskripsi 1
                if ($infographkabupatenkota[4]['nilai'] >= $infographkabupatenkota[5]['nilai']) {
                    $status_capaian = '<b>di bawah</b>';
                } elseif ($infographkabupatenkota[4]['nilai'] <= $infographkabupatenkota[5]['nilai']) {
                    $status_capaian = '<b>di atas</b>';
                } elseif ($infographkabupatenkota[4]['nilai'] == $infographkabupatenkota[5]['nilai']) {
                    $status_capaian = '<b>sama dengan</b>';
                } else {
                    $status_capaian = '<b>unknown</b>';
                }
                //end sparator deskripsi 1

                //sparator nasional dan daerah deskripsi 2
                if ($infographprovinsi[5]['nasional'] >= $infographkabupatenkota[5]['nilai']) {
                    $status_capaian_indikator_nasional_daerah = '<b>di bawah</b>';
                } elseif ($infographprovinsi[5]['nasional'] <= $infographkabupatenkota[5]['nilai']) {
                    $status_capaian_indikator_nasional_daerah = '<b>di atas</b>';
                } elseif ($infographprovinsi[5]['nasional'] == $infographkabupatenkota[5]['nilai']) {
                    $status_capaian_indikator_nasional_daerah = '<b>sama dengan</b>';
                } else {
                    $status_capaian_indikator_nasional_daerah = '<b>unknown</b>';
                }
                //end sparator nasional dan daerah deskripsi 2

                //sparator provinsi dan daerah deskripsi 2
                if ($infographprovinsi[5]['nilai'] >= $infographkabupatenkota[5]['nilai']) {
                    $status_capaian_indikator_provinsi_daerah = '<b>di bawah</b>';
                } elseif ($infographprovinsi[5]['nilai'] <= $infographkabupatenkota[5]['nilai']) {
                    $status_capaian_indikator_provinsi_daerah = '<b>di atas</b>';
                } elseif ($infographprovinsi[5]['nilai'] == $infographkabupatenkota[5]['nilai']) {
                    $status_capaian_indikator_provinsi_daerah = '<b>sama dengan</b>';
                } else {
                    $status_capaian_indikator_provinsi_daerah = '<b>unknown</b>';
                }
                //end sparator provinsi dan daerah deskripsi 2

                //nilai deskripsi 1
                if ($infographkabupatenkota[5]['satuan'] == '%') {
                    $nilaikabupatenkota4 = round($infographkabupatenkota[4]['nilai'], 2) . '' . $infographkabupatenkota[4]['satuan'];
                    $nilaikabupatenkota5 = round($infographkabupatenkota[5]['nilai'], 2) . '' . $infographkabupatenkota[5]['satuan'];
                } elseif ($infographkabupatenkota[5]['satuan'] == 'Rp') {
                    $nilaikabupatenkota4 = $infographkabupatenkota[4]['satuan'] . ' ' . number_format($infographkabupatenkota[4]['nilai'], 0, ',', '.');
                    $nilaikabupatenkota5 = $infographkabupatenkota[5]['satuan'] . ' ' . number_format($infographkabupatenkota[5]['nilai'], 0, ',', '.');
                } elseif ($infographkabupatenkota[5]['satuan'] == 'Orang') {
                    $nilaikabupatenkota4 = number_format($infographkabupatenkota[4]['nilai'], 0, ',', '.') . ' ' . $infographkabupatenkota[4]['satuan'];
                    $nilaikabupatenkota5 = number_format($infographkabupatenkota[5]['nilai'], 0, ',', '.') . ' ' . $infographkabupatenkota[5]['satuan'];
                } elseif ($infographkabupatenkota[5]['satuan'] == 'Tahun') {
                    $nilaikabupatenkota4 = number_format($infographkabupatenkota[4]['nilai'], 2, ',', '.') . ' ' . $infographkabupatenkota[4]['satuan'];
                    $nilaikabupatenkota5 = number_format($infographkabupatenkota[5]['nilai'], 2, ',', '.') . ' ' . $infographkabupatenkota[5]['satuan'];
                } else {
                    $nilaikabupatenkota4 = $infographkabupatenkota[4]['nilai'];
                    $nilaikabupatenkota5 = $infographkabupatenkota[5]['nilai'];
                }
                //end nilai deskripsi 1

                //nilai deskripsi 2
                if ($infographkabupatenkota[5]['satuan'] == '%') {
                    $nilaidaerah = round($infographkabupatenkota[5]['nilai'], 2) . '' . $infographkabupatenkota[5]['satuan'];
                    $nilaiprovinsi = round($infographprovinsi[5]['nilai'], 2) . '' . $infographprovinsi[5]['satuan'];
                    $nilainasional = round($infographprovinsi[5]['nasional'], 2) . '' . $infographprovinsi[5]['satuan'];
                } elseif ($infographkabupatenkota[5]['satuan'] == 'Rp') {
                    $nilaidaerah = $infographkabupatenkota[5]['satuan'] . ' ' . number_format($infographkabupatenkota[5]['nilai'], 0, ',', '.');
                    $nilaiprovinsi = $infographprovinsi[5]['satuan'] . ' ' . number_format($infographprovinsi[5]['nilai'], 0, ',', '.');
                    $nilainasional = $infographprovinsi[5]['satuan'] . ' ' . number_format($infographprovinsi[5]['nasional'], 0, ',', '.');
                } elseif ($infographkabupatenkota[5]['satuan'] == 'Orang') {
                    $nilaidaerah = number_format($infographkabupatenkota[5]['nilai'], 0, ',', '.') . ' ' . $infographkabupatenkota[5]['satuan'];
                    $nilaiprovinsi = number_format($infographprovinsi[5]['nilai'], 0, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                    $nilainasional = number_format($infographprovinsi[5]['nasional'], 0, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                } elseif ($infographkabupatenkota[5]['satuan'] == 'Tahun') {
                    $nilaidaerah = number_format($infographkabupatenkota[5]['nilai'], 2, ',', '.') . ' ' . $infographkabupatenkota[5]['satuan'];
                    $nilaiprovinsi = number_format($infographprovinsi[5]['nilai'], 2, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                    $nilainasional = number_format($infographprovinsi[5]['nasional'], 2, ',', '.') . ' ' . $infographprovinsi[5]['satuan'];
                } else {
                    $nilaidaerah = $infographkabupatenkota[5]['nilai'];
                    $nilaiprovinsi = $infographprovinsi[5]['nilai'];
                    $nilainasional = $infographprovinsi[5]['nasional'];
                }
                //end nilai deskripsi 2

                $change_indicator_name = str_replace("[nama indikator]", $indikatorTable[0]['nama_indikator'], $data['description2'][0]->deskripsi);

                $change_region = str_replace("[nama daerah]", $subWilayah[0]['nama_kabupaten'], $change_indicator_name);

                $this_month_year = strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[5]['periode'])) . " " . $infographkabupatenkota[5]['tahun'];
                $change_this_month_year = str_replace("[bulan - tahun ini]", $this_month_year, $change_region);

                $change_status_capaian = str_replace("[sparator tahun ini dengan tahun sebelumnya]", $status_capaian, $change_this_month_year);

                $previous_month_year = strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[4]['periode'])) . " " . $infographkabupatenkota[4]['tahun'];
                $change_previous_month_year = str_replace("[bulan - 1 tahun lalu]", $previous_month_year, $change_status_capaian);

                $change_nilai = str_replace("[nilai saat ini]", $nilaikabupatenkota5, $change_previous_month_year);

                $change_nilai_2 = str_replace("[nilai 1 tahun sebelumnya]", $nilaikabupatenkota4, $change_nilai);

                $change_status_capaian_indikator_nasional_daerah = str_replace("[sparator nilai daerah dengan nilai nasional]", $status_capaian_indikator_nasional_daerah, $change_nilai_2);

                $change_status_capaian_indikator_provinsi_daerah = str_replace("[sparator nilai daerah dengan nilai provinsi]", $status_capaian_indikator_provinsi_daerah, $change_status_capaian_indikator_nasional_daerah);

                $change_nilai_daerah = str_replace("[nilai daerah saat ini]", $nilaidaerah, $change_status_capaian_indikator_provinsi_daerah);

                $change_nilai_nasional = str_replace("[nilai nasional saat ini]", $nilainasional, $change_nilai_daerah);

                $change_nilai_provinsi = str_replace("[nilai provinsi saat ini]", $nilaiprovinsi, $change_nilai_nasional);

                $data['deskripsi_indikator2'] = $change_nilai_provinsi;
            }
        } else {
            $data['deskripsi_indikator2'] = '';
        }
        //end deskripsi 2



        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_infograph_4', $data);
        $this->load->view('pages/include/V_footer');
    }

    public function kegiatan()
    {
        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_kegiatan');
        $this->load->view('pages/include/V_footer');
    }

    public function karir()
    {
        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_career');
        $this->load->view('pages/include/V_footer');
    }

    public function penghargaan()
    {
        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_penghargaan_2');
        $this->load->view('pages/include/V_footer');
    }

    public function pemantauan()
    {
        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_pemantauan');
        $this->load->view('pages/include/V_footer');
    }

    public function evaluasi()
    {
        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $category = $this->m_article->selectdistinctorderbydesc('id_category', 'created_at', 'DESC');

        for ($i = 0; $i < count($category); $i++) {
            $data['carousel_content'][$i] = $this->m_article->joinCategorieswhere2limit('status', 'publish', 'id_category', $category[$i]->id_category, '1');
        }

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_evaluasi', $data);
        $this->load->view('pages/include/V_footer');
    }

    public function koordinasi()
    {
        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_koordinasi');
        $this->load->view('pages/include/V_footer');
    }

    public function profil_ppd()
    {
        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_profil_ppd');
        $this->load->view('pages/include/V_footer');
    }

    public function pedoman_ppd()
    {
        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_pedoman_ppd');
        $this->load->view('pages/include/V_footer');
    }

    public function infograph()
    {
        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_infograph_2');
        $this->load->view('pages/include/V_footer');
    }
}