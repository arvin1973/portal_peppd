<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_infographController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_guide', 'm_guide');
        $this->load->model('M_article', 'm_article');
        $this->load->model('M_logPortal', 'm_logPortal');
        $this->load->model('M_description_indicator', 'm_description_indicator');

        $this->load->helper("prov");
        $this->load->helper("coordinat");
        $this->load->helper("jawa");
        $this->load->helper("blntbntt");
        $this->load->helper("kalimantan");
        $this->load->helper("sulawesi");
        $this->load->helper("malpa");
    }

    public function saveDecriptionIndicator()
    {

        $where_description_indicator = array(
            'id_indikator' => $this->input->post('id_indikator'),
            'wilayah' => $this->input->post('wilayah'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $data['description'] = $this->m_description_indicator->getby($where_description_indicator);

        if ($data['description'] == null) {

            $item_description_indicator = array(
                'id_indikator' => $this->input->post('id_indikator'),
                'wilayah' => $this->input->post('wilayah'),
                'keterangan' => $this->input->post('keterangan'),
                'deskripsi' => $this->input->post('deskripsi'),
            );
            $description_indicator = $this->m_description_indicator->add($item_description_indicator);

            $where_description_indicator = array(
                'id_indikator' => $this->input->post('id_indikator'),
                'wilayah' => $this->input->post('wilayah'),
                'keterangan' => $this->input->post('keterangan'),
            );
            $description = $this->m_description_indicator->getby($where_description_indicator);

            $action = 'membuat deskripsi indikator pada id indikator = ' . $this->input->post('id_indikator') . ' di wilayah = ' . $this->input->post('wilayah') . ' pada ' . $this->input->post('keterangan');
            $ip = $_SERVER['REMOTE_ADDR'];

            $getloc = json_decode(file_get_contents("http://ipinfo.io/"));
            $location = $getloc->city;

            $item_logPortal = array(
                'action' => $action,
                'location' => $location,
                'ip' => $ip,
            );
            $LogPortal = $this->m_logPortal->add($item_logPortal);
        } else {

            $item_description_indicator = array(
                'id_indikator' => $this->input->post('id_indikator'),
                'wilayah' => $this->input->post('wilayah'),
                'keterangan' => $this->input->post('keterangan'),
                'deskripsi' => $this->input->post('deskripsi'),
            );
            $description_indicator = $this->m_description_indicator->edit($data['description'][0]->id, $item_description_indicator);

            $where_description_indicator = array(
                'id_indikator' => $this->input->post('id_indikator'),
                'wilayah' => $this->input->post('wilayah'),
                'keterangan' => $this->input->post('keterangan'),
            );
            $description = $this->m_description_indicator->getby($where_description_indicator);

            $action = 'mengubah deskripsi indikator pada id indikator = ' . $this->input->post('id_indikator') . ' di wilayah = ' . $this->input->post('wilayah') . ' pada ' . $this->input->post('wilayah');
            $ip = $_SERVER['REMOTE_ADDR'];

            $getloc = json_decode(file_get_contents("http://ipinfo.io/"));
            $location = $getloc->city;

            $item_logPortal = array(
                'action' => $action,
                'location' => $location,
                'ip' => $ip,
            );
            $LogPortal = $this->m_logPortal->add($item_logPortal);
        }

        if ($this->input->post('wilayah') == 'nasional') {

            setlocale(LC_TIME, 'id_ID', 'Indonesian_indonesia', 'Indonesian');

            $db2 = $this->load->database('pemantauan', TRUE);

            //nama indikator
            $indikatorTable = $db2->query("SELECT * FROM indikator WHERE id = '" . $this->input->post('id_indikator') . "'")->result_array();

            $infographnasional = $db2->query("SELECT * FROM (SELECT * FROM nilai_indikator WHERE (id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='1000') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

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

            $change_indicator_name = str_replace("[nama indikator]", $indikatorTable[0]['nama_indikator'], $description[0]->deskripsi);

            $this_month_year = strftime("%B", mktime(0, 0, 0, $infographnasional[5]['periode'])) . " " . $infographnasional[5]['tahun'];
            $change_this_month_year = str_replace("[bulan - tahun ini]", $this_month_year, $change_indicator_name);

            $change_status_capaian = str_replace("[sparator tahun ini dengan tahun sebelumnya]", $status_capaian, $change_this_month_year);

            $previous_month_year = strftime("%B", mktime(0, 0, 0, $infographnasional[4]['periode'])) . " " . $infographnasional[4]['tahun'];
            $change_previous_month_year = str_replace("[bulan - 1 tahun lalu]", $previous_month_year, $change_status_capaian);

            $change_nilai = str_replace("[nilai saat ini]", $nilainasional5, $change_previous_month_year);

            echo $change_nilai;
        } else if ($this->input->post('wilayah') == 'provinsi') {

            setlocale(LC_TIME, 'id_ID', 'Indonesian_indonesia', 'Indonesian');

            $db2 = $this->load->database('pemantauan', TRUE);

            //nama indikator
            $indikatorTable = $db2->query("SELECT * FROM indikator WHERE id = '" . $this->input->post('id_indikator') . "'")->result_array();

            $infographprovinsi = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='" . $this->input->post('kodeSubWilayah') . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='" . $this->input->post('kodeSubWilayah') . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

            $subWilayah = $db2->query("SELECT * FROM provinsi WHERE id ='" . $this->input->post('kodeSubWilayah') . "'")->result_array();

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

            $change_indicator_name = str_replace("[nama indikator]", $indikatorTable[0]['nama_indikator'], $description[0]->deskripsi);

            $change_province = str_replace("[nama daerah]", $subWilayah[0]['nama_provinsi'], $change_indicator_name);

            $this_month_year = strftime("%B", mktime(0, 0, 0, $infographprovinsi[5]['periode'])) . " " . $infographprovinsi[5]['tahun'];
            $change_this_month_year = str_replace("[bulan - tahun ini]", $this_month_year, $change_province);

            $change_status_capaian = str_replace("[sparator tahun ini dengan tahun sebelumnya]", $status_capaian, $change_this_month_year);

            $previous_month_year = strftime("%B", mktime(0, 0, 0, $infographprovinsi[4]['periode'])) . " " . $infographprovinsi[4]['tahun'];
            $change_previous_month_year = str_replace("[bulan - 1 tahun lalu]", $previous_month_year, $change_status_capaian);

            $change_nilai = str_replace("[nilai saat ini]", $nilaiprovinsi5, $change_previous_month_year);

            $change_nilai_2 =  str_replace("[nilai 1 tahun sebelumnya]", $nilaiprovinsi4, $change_nilai);

            $change_status_capaian_indikator = str_replace("[sparator nilai daerah dengan nilai nasional]", $status_capaian_indikator, $change_nilai_2);

            $change_nilai_daerah = str_replace("[nilai daerah saat ini]", $nilaiprovinsi, $change_status_capaian_indikator);

            $change_nilai_nasional = str_replace("[nilai nasional saat ini]", $nilainasional, $change_nilai_daerah);

            echo $change_nilai_nasional;
        } else if ($this->input->post('wilayah') == 'kabupatenkota') {

            setlocale(LC_TIME, 'id_ID', 'Indonesian_indonesia', 'Indonesian');

            $db2 = $this->load->database('pemantauan', TRUE);

            //nama indikator
            $indikatorTable = $db2->query("SELECT * FROM indikator WHERE id = '" . $this->input->post('id_indikator') . "'")->result_array();

            $infographprovinsi = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='" . $this->input->post('kodeProvinsi') . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='" . $this->input->post('kodeProvinsi') . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

            $infographkabupatenkota = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='" . $this->input->post('kodeSubWilayah') . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='" . $this->input->post('kodeSubWilayah') . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();

            // $infographkabupatenkota = $db2->query("SELECT REF.id_periode,IFNULL(IND.nilai,0) nilai_kab
            //                     FROM(
            //                             select DISTINCT id_periode from nilai_indikator 
            //                             where (id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='1000') 
            //                             AND (id_periode, versi) in (
            //                                                                     select id_periode, max(versi) as versi 
            //                                                                     from nilai_indikator 
            //                                                     WHERE id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='1000' group by id_periode
            //                                                                                )
            //                             order by id_periode 
            //                             Desc limit 6 
            //                     ) REF
            //                     LEFT JOIN(
            //                             select id_periode,nilai 
            //                             from nilai_indikator 
            //                             where (id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='" . $this->input->post('kodeSubWilayah') . "')
            //                             AND (id_periode, versi) in (
            //                                                     select id_periode, max(versi) as versi  
            //                                     from nilai_indikator 
            //                                     WHERE id_indikator='" . $this->input->post('id_indikator') . "' AND wilayah='" . $this->input->post('kodeSubWilayah') . "' group by id_periode
            //                                     ) 
            //                                     group by id_periode 
            //                                     order by id_periode Desc limit 6
            //                     ) IND	ON REF.id_periode=IND.id_periode
            //                     order by id_periode")->result_array();

            $subWilayah = $db2->query("SELECT * FROM kabupaten WHERE id ='" . $this->input->post('kodeSubWilayah') . "'")->result_array();

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
            // print_r($infographprovinsi);
            // die();
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

            $change_indicator_name = str_replace("[nama indikator]", $indikatorTable[0]['nama_indikator'], $description[0]->deskripsi);

            $change_region = str_replace("[nama daerah]", $subWilayah[0]['nama_kabupaten'], $change_indicator_name);

            $this_month_year = strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[5]['periode'])) . " " . $infographkabupatenkota[5]['tahun'];
            $change_this_month_year = str_replace("[bulan - tahun ini]", $this_month_year, $change_region);

            $change_status_capaian = str_replace("[sparator tahun ini dengan tahun sebelumnya]", $status_capaian, $change_this_month_year);

            $previous_month_year = strftime("%B", mktime(0, 0, 0, $infographkabupatenkota[4]['periode'])) . " " . $infographkabupatenkota[4]['tahun'];
            $change_previous_month_year = str_replace("[bulan - 1 tahun lalu]", $previous_month_year, $change_status_capaian);

            $change_nilai = str_replace("[nilai saat ini]", $nilaikabupatenkota5, $change_previous_month_year);

            $change_nilai_2 =  str_replace("[nilai 1 tahun sebelumnya]", $nilaikabupatenkota4, $change_nilai);

            $change_status_capaian_indikator_nasional_daerah =  str_replace("[sparator nilai daerah dengan nilai nasional]", $status_capaian_indikator_nasional_daerah, $change_nilai_2);

            $change_status_capaian_indikator_provinsi_daerah =  str_replace("[sparator nilai daerah dengan nilai provinsi]", $status_capaian_indikator_provinsi_daerah, $change_status_capaian_indikator_nasional_daerah);

            $change_nilai_daerah =  str_replace("[nilai daerah saat ini]", $nilaidaerah, $change_status_capaian_indikator_provinsi_daerah);

            $change_nilai_nasional =  str_replace("[nilai nasional saat ini]", $nilainasional, $change_nilai_daerah);

            $change_nilai_provinsi =  str_replace("[nilai provinsi saat ini]", $nilaiprovinsi, $change_nilai_nasional);

            echo $change_nilai_provinsi;
        }

        // $this->form_validation->set_error_delimiters('', '');
        // $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[25]');
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        // $this->form_validation->set_rules('comment', 'Comment', 'trim|required|max_length[255]');

        // if ($this->form_validation->run() == FALSE) {
        //     echo validation_errors();
        // } else {
        //     $item_comment = array(
        //         'id_article' => $this->input->post('id_article'),
        //         'id_comment' => $this->input->post('id_comment'),
        //         'name' => $this->input->post('name'),
        //         'email' => $this->input->post('email'),
        //         'comment' => $this->input->post('comment'),
        //     );
        //     $comment = $this->m_comment->add($item_comment);

        //     $action = $this->input->post('name') . ' memberikan komentar article dengan id_article = ' . $this->input->post('id_article');
        //     $ip = $_SERVER['REMOTE_ADDR'];

        //     $getloc = json_decode(file_get_contents("http://ipinfo.io/"));
        //     $location = $getloc->city;

        //     $item_logPortal = array(
        //         'action' => $action,
        //         'location' => $location,
        //         'ip' => $ip,
        //     );
        //     $LogPortal = $this->m_logPortal->add($item_logPortal);

        //     echo $comment;
        // }
    }

    public function index()
    {
        /* $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('indikator', 'Indikator', 'trim|max_length[255]');
        $this->form_validation->set_rules('wilayah', 'Wilayah', 'trim|max_length[255]');
        $this->form_validation->set_rules('subWilayah', 'Sub Wilayah', 'trim|max_length[255]');
        $this->form_validation->set_rules('kabupatenkota', 'Kabupaten Kota', 'trim|max_length[255]'); */

        /* if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            $indikator = $this->input->post('indikator');
            $wilayah = $this->input->post('wilayah');
            $subWilayah = $this->input->post('subWilayah');
            $kabupatenkota = $this->input->post('kabupatenkota');

            $db2 = $this->load->database('pemantauan', TRUE);

            if ($indikator == 'Pertumbuhan Ekonomi') {
                $IndikatorTable = $db2->query("SELECT * FROM indikator WHERE nama_indikator = '" . $indikator . "'")->result();
                if ($wilayah == 'nasional') {
                    $infograph = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='1' AND wilayah='1000') AND periode !='01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='1' AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result();
                } else if ($wilayah == 'provinsi') {
                } else if ($wilayah == 'kabupatenkota') {
                } else {
                    $infograph = 'Wilayah belum diisi';
                }
            } else {
                $infograph = 'Indikator belum diisi';
            }

            $json_data = array(
                "indikator" => $IndikatorTable,
                "data" => $infograph,
            );

            echo json_encode($json_data);

            $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
            $nav['last_guide'] = $this->m_guide->getallorderbydesc();

            echo $_GET['indikator'];
            die();

            $this->load->view('pages/include/V_header', $nav);
            $this->load->view('pages/main/V_infograph_2');
            $this->load->view('pages/include/V_footer');
        } */



        $db2 = $this->load->database('pemantauan', TRUE);

        $data['list_indikator'] = $db2->query("SELECT * FROM indikator")->result_array();
        $data['list_provinsi'] = $db2->query("SELECT * FROM provinsi")->result_array();

        if (isset($_GET['indikator'])) {
            $data['indikator'] = strtolower(str_replace("_", " ", $_GET['indikator']));
            $data['IndikatorTable'] = $db2->query("SELECT * FROM indikator WHERE nama_indikator = '" . $data['indikator'] . "'")->result_array();
        } else {
            $data['indikator'] = null;
        }
        if($this->input->get('wilayah')){
            $data['wilayah'] = strtolower(str_replace("_", " ", $_GET['wilayah']));
        } else {
            $data['wilayah'] = '';
        }
        /*if (isset($_GET['wilayah'])) {
            $data['wilayah'] = strtolower(str_replace("_", " ", $_GET['wilayah']));
        } else {
            $data['wilayah'] = '';
        }
        */
        if (isset($_GET['subWilayah'])) {
            $kodeSubWilayah = $_GET['subWilayah'];
            $data['subWilayah'] = $db2->query("SELECT * FROM provinsi WHERE id ='" . $kodeSubWilayah . "'")->result_array();
        }
        if (isset($_GET['kabupatenkota'])) {
            $kodeKabupatenKota = $_GET['kabupatenkota'];
            $data['kodeKabkota'] = $_GET['kabupatenkota'];
            $data['subWilayahDaerah'] = $db2->query("SELECT * FROM kabupaten WHERE id ='" . $kodeKabupatenKota . "'")->result_array();
        }

        if ($data['wilayah'] == 'nasional') {
            $data['infographnasional'] = $db2->query("SELECT * FROM (SELECT * FROM nilai_indikator WHERE (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();
        } else if ($data['wilayah'] == 'provinsi') {
            $data['infographprovinsi'] = $db2->query("SELECT * FROM (SELECT * FROM nilai_indikator WHERE (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();
            if (isset($data['infographprovinsi'][5])) {
                $data['graphperbandinganwilayah'] = $db2->query("SELECT p.label AS label, p.nama_provinsi AS nama_daerah, e.* FROM provinsi p JOIN nilai_indikator e ON p.id = e.wilayah WHERE (e.id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND e.id_periode='" . $data['infographprovinsi'][5]['id_periode'] . "') AND periode != '01' AND (wilayah, versi) IN (SELECT x.wilayah, max(x.versi) AS versi FROM nilai_indikator x WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND id_periode='" . $data['infographprovinsi'][5]['id_periode'] . "' GROUP BY wilayah) GROUP BY wilayah ORDER BY wilayah ASC")->result_array();
            }
        } else if ($data['wilayah'] == 'kabupatenkota') {
            $sql_nilai_indikator = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000') AND periode !='01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result();
            foreach ($sql_nilai_indikator as $row_sql) {
                $idperiode[] = $row_sql->id_periode;
            }
            $periode_kab_max = max($idperiode);
            $data['graphperbandinganwilayah'] = $db2->query("select p.nama_kabupaten as label, p.nama_kabupaten as nama_daerah, e.* from kabupaten p join nilai_indikator e on p.id = e.wilayah where p.prov_id='" . $kodeSubWilayah . "' and (e.id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND e.id_periode='" . $periode_kab_max . "') AND periode != '01' AND (wilayah, versi) in (select x.wilayah, max(x.versi) as versi from nilai_indikator x  where id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND id_periode='" . $periode_kab_max . "' group by wilayah ) group by wilayah order by wilayah asc")->result_array();
            $data['infographprovinsi'] = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();
            $data['infographkabupatenkota'] = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();
            // $data['infographkabupatenkota'] = $db2->query("SELECT REF.id_periode,IFNULL(IND.nilai,0) nilai_kab
            //                     FROM(
            //                             select DISTINCT id_periode from nilai_indikator 
            //                             where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000') 
            //                             AND (id_periode, versi) in (
            //                                                                     select id_periode, max(versi) as versi 
            //                                                                     from nilai_indikator 
            //                                                     WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000' group by id_periode
            //                                                                                )
            //                             order by id_periode 
            //                             Desc limit 6 
            //                     ) REF
            //                     LEFT JOIN(
            //                             select id_periode,nilai 
            //                             from nilai_indikator 
            //                             where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "')
            //                             AND (id_periode, versi) in (
            //                                                     select id_periode, max(versi) as versi  
            //                                     from nilai_indikator 
            //                                     WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeSubWilayah . "' group by id_periode
            //                                     ) 
            //                                     group by id_periode 
            //                                     order by id_periode Desc limit 6
            //                     ) IND	ON REF.id_periode=IND.id_periode
            //                     order by id_periode")->result_array();
        } else {
            $data['infograph'] = 'Wilayah belum diisi';
        }

        $nav['last_article'] = $this->m_article->getallorderbydescwhere1('status', 'publish');
        $nav['last_guide'] = $this->m_guide->getallorderbydesc();

        //deskripsi 1
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

                $change_nilai_2 =  str_replace("[nilai 1 tahun sebelumnya]", $nilaiprovinsi4, $change_nilai);

                $data['deskripsi_indikator'] = $change_nilai_2;
            } elseif ($data['wilayah'] == 'kabupatenkota') {

                $db2 = $this->load->database('pemantauan', TRUE);

                //nama indikator
                $indikatorTable = $db2->query("SELECT * FROM indikator WHERE id = '" . $data['IndikatorTable'][0]['id'] . "'")->result_array();

                $infographkabupatenkota = $db2->query("SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "') AND periode != '01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC")->result_array();
                // $data['infographkabupatenkota'] = $db2->query("SELECT REF.id_periode,IFNULL(IND.nilai,0) nilai_kab
                //                 FROM(
                //                         select DISTINCT id_periode from nilai_indikator 
                //                         where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000') 
                //                         AND (id_periode, versi) in (
                //                                                                 select id_periode, max(versi) as versi 
                //                                                                 from nilai_indikator 
                //                                                 WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000' group by id_periode
                //                                                                            )
                //                         order by id_periode 
                //                         Desc limit 6 
                //                 ) REF
                //                 LEFT JOIN(
                //                         select id_periode,nilai 
                //                         from nilai_indikator 
                //                         where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "')
                //                         AND (id_periode, versi) in (
                //                                                 select id_periode, max(versi) as versi  
                //                                 from nilai_indikator 
                //                                 WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "' group by id_periode
                //                                 ) 
                //                                 group by id_periode 
                //                                 order by id_periode Desc limit 6
                //                 ) IND	ON REF.id_periode=IND.id_periode
                //                 order by id_periode")->result_array();

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

                $change_nilai_2 =  str_replace("[nilai 1 tahun sebelumnya]", $nilaikabupatenkota4, $change_nilai);

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

                $change_nilai_2 =  str_replace("[nilai 1 tahun sebelumnya]", $nilaiprovinsi4, $change_nilai);

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
                // $infographkabupatenkota = $db2->query("SELECT REF.id_periode,IFNULL(IND.nilai,0) nilai_kab
                //                 FROM(
                //                         select DISTINCT id_periode from nilai_indikator 
                //                         where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000') 
                //                         AND (id_periode, versi) in (
                //                                                                 select id_periode, max(versi) as versi 
                //                                                                 from nilai_indikator 
                //                                                 WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='1000' group by id_periode
                //                                                                            )
                //                         order by id_periode 
                //                         Desc limit 6 
                //                 ) REF
                //                 LEFT JOIN(
                //                         select id_periode,nilai 
                //                         from nilai_indikator 
                //                         where (id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "')
                //                         AND (id_periode, versi) in (
                //                                                 select id_periode, max(versi) as versi  
                //                                 from nilai_indikator 
                //                                 WHERE id_indikator='" . $data['IndikatorTable'][0]['id'] . "' AND wilayah='" . $kodeKabupatenKota . "' group by id_periode
                //                                 ) 
                //                                 group by id_periode 
                //                                 order by id_periode Desc limit 6
                //                 ) IND	ON REF.id_periode=IND.id_periode
                //                 order by id_periode")->result_array();

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

                $change_nilai_2 =  str_replace("[nilai 1 tahun sebelumnya]", $nilaikabupatenkota4, $change_nilai);

                $change_status_capaian_indikator_nasional_daerah =  str_replace("[sparator nilai daerah dengan nilai nasional]", $status_capaian_indikator_nasional_daerah, $change_nilai_2);

                $change_status_capaian_indikator_provinsi_daerah =  str_replace("[sparator nilai daerah dengan nilai provinsi]", $status_capaian_indikator_provinsi_daerah, $change_status_capaian_indikator_nasional_daerah);

                $change_nilai_daerah =  str_replace("[nilai daerah saat ini]", $nilaidaerah, $change_status_capaian_indikator_provinsi_daerah);

                $change_nilai_nasional =  str_replace("[nilai nasional saat ini]", $nilainasional, $change_nilai_daerah);

                $change_nilai_provinsi =  str_replace("[nilai provinsi saat ini]", $nilaiprovinsi, $change_nilai_nasional);

                $data['deskripsi_indikator2'] = $change_nilai_provinsi;
            }
        } else {
            $data['deskripsi_indikator2'] = '';
        }
        //end deskripsi 2

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_infograph_2', $data);
        $this->load->view('pages/include/V_footer');
    }

    public function test(){
        

        $this->load->view('pages/include/V_header', $nav);
        $this->load->view('pages/main/V_infograph_2', $data);
        $this->load->view('pages/include/V_footer');

    }

    //peta

    function peta()
    {
        if ($this->input->is_ajax_request()) {
            try {
                //$db2 = $this->load->database('pemantauan', TRUE);
                $this->db2        = $this->load->database('pemantauan', TRUE);

                $requestData = $_REQUEST;
                $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
                $this->form_validation->set_rules('indikator', 'Indikator', 'required');
                $kabkot = $this->input->post("kabupatenkota");
                $pro = $this->input->post("provinsi");
                $ind = $this->input->post("indikator");
                // print_r($ind);
                // exit();

                $bulan = array('00' => '', '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Ags', '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des',);
                $prde  = array('01' => 'TWL I', '02' => 'TWL II', '03' => 'TWL III', '0' => '0', '00' => '00', '08' => '08', '09' => '09', '000' => '000');
                $posisi  = array(
                    '1100' => [96.699389, 4.713777], '1200' => [99.505662, 2.214178], '1300' => [101.030895, -0.709370], '1400' => [101.694295, 0.337480], '1500' => [102.447403, -1.444049], '1600' => [104.090464, -3.196092], '1700' => [102.234200, -3.574566], '1800' => [105.149064, -4.874095], '1900' => [106.841340, -2.303002], '2100' => [104.629934, 0.883574], '3100' => [106.850787, -6.206519], '3200' => [107.768762, -6.942884], '3300' => [109.998987, -7.313526], '3400' => [110.462457, -7.850908], '3500' => [112.644437, -7.585143], '3600' => [106.120118, -6.373885], '5100' => [115.183905, -8.408885], '5200' => [117.364766, -8.653642], '5300' => [122.367551, -9.007799], '6100' => [111.154836, -0.081797], '6200' => [113.538086, -1.591910], '6300' => [115.511801, -2.994677], '6400' => [116.491959, 0.592887], '6500' => [116.252830, 3.157217], '7100' => [124.464421, 0.943605],
                    '7200' => [120.985712, -0.824342], '7300' => [119.922324, -3.585060], '7400' => [122.263216, -4.009943], '7500' => [122.509390, 0.701081], '7600' => [119.285441, -2.450009], '8100' => [130.535005, -3.598017], '8200' => [127.826539, 0.742708], '9100' => [132.783737, -1.926649], '9400' => [138.775450, -4.486719]
                );


                $xname      = "";
                $query      = "";
                $title      = "Perkembangan Pertumbuhan Ekonomi tahun";
                $thn_a      = '';
                $max_pe_p   = '';
                $pe_rkpd_rkp = '';
                $kord       = '';
                $nilai_peta = '';
                $nilainsl = 0;
                $js_zoom = 0;
                $js_tengah = [];
                $query_indikator = "select * from indikator where id ='" . $ind . "'";
                $indikator = $this->db2->query($query_indikator)->result_array();
                $nm_ind = $indikator[0]['nama_indikator'];
                $satuan_ind = $indikator[0]['satuan'];
                if ($pro == '1000') {

                    $nsl = "select id_periode,nilai, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $ind . "' AND wilayah='1000' ";
                    $list_nsl  = $this->db2->query($nsl);
                    foreach ($list_nsl->result() as $row_n) {
                        $nilainsl = "Nasional : " . $row_n->nilai;
                    }

                    $sql = "SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $ind . "' AND wilayah='1000') AND periode !='01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $ind . "' AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC";
                    $list_data = $this->db2->query($sql);
                    foreach ($list_data->result() as $row) {
                        $periode_pe[]           = $row->id_periode;
                    }
                    $periode_pe_max = max($periode_pe);

                    $perbandingan_pro = "select p.label as label,p.nama_provinsi, i.jenis, e.* 
                                        from provinsi p 
                                        join nilai_indikator e on p.id = e.wilayah
                                        join indikator i on i.id = e.id_indikator
                                        where (e.id_indikator='" . $ind . "'
                                        AND e.id_periode='$periode_pe_max') 
                                        AND periode != '01'
                                        AND (wilayah, versi) in (select x.wilayah, max(x.versi) as versi 
                                from nilai_indikator x  
                                where id_indikator='" . $ind . "' AND id_periode='$periode_pe_max' 
                                group by wilayah) group by wilayah order by wilayah asc";

                    $list_ppe_per = $this->db2->query($perbandingan_pro);
                    foreach ($list_ppe_per->result() as $row_ppe_per) {
                        // ubah format nilai
                        if ($row_ppe_per->satuan == '%') {
                            $target = round((float)$row_ppe_per->target, 2);
                            $target_t_m_rpjmn = round((float)$row_ppe_per->t_m_rpjmn, 2);
                            $target_t_rkpd = round((float)$row_ppe_per->t_rkpd, 2);
                            $target_t_k_rkp = round((float)$row_ppe_per->t_k_rkp, 2);
                            $nasional = round((float)$row_ppe_per->nasional, 2);
                            $population = round((float)$row_ppe_per->nilai, 2);
                        } elseif ($row_ppe_per->satuan == 'Rp') {
                            $target = number_format((float)$row_ppe_per->target, 0, ',', '.');
                            $target_t_m_rpjmn = number_format((float)$row_ppe_per->t_m_rpjmn, 0, ',', '.');
                            $target_t_rkpd = number_format((float)$row_ppe_per->t_rkpd, 0, ',', '.');
                            $target_t_k_rkp = number_format((float)$row_ppe_per->t_k_rkp, 0, ',', '.');
                            $nasional = number_format((float)$row_ppe_per->nasional, 0, ',', '.');
                            $population = number_format((float)$row_ppe_per->nilai, 0, ',', '.');
                        } elseif ($row_ppe_per->satuan == 'Orang') {
                            $target = number_format((float)$row_ppe_per->target, 0, ',', '.');
                            $target_t_m_rpjmn = number_format((float)$row_ppe_per->t_m_rpjmn, 0, ',', '.');
                            $target_t_rkpd = number_format((float)$row_ppe_per->t_rkpd, 0, ',', '.');
                            $target_t_k_rkp = number_format((float)$row_ppe_per->t_k_rkp, 0, ',', '.');
                            $nasional = number_format((float)$row_ppe_per->nasional, 0, ',', '.');
                            $population = number_format((float)$row_ppe_per->nilai, 0, ',', '.');
                        } else {
                            $target = (float)$row_ppe_per->target;
                            $target_t_m_rpjmn = (float)$row_ppe_per->t_m_rpjmn;
                            $target_t_rkpd = (float)$row_ppe_per->t_rkpd;
                            $target_t_k_rkp = (float)$row_ppe_per->t_k_rkp;
                            $nasional = (float)$row_ppe_per->nasional;
                            $population = (float)$row_ppe_per->nilai;
                        }
                        // end ubah format nilai
                        $idwill = $row_ppe_per->wilayah;
                        $lt = nama_provinsi($idwill);
                        if ($idwill == '3100' || $idwill == '3400') {
                            $jenis = 'Polygon';
                        } else {
                            $jenis = 'MultiPolygon';
                        }
                        $type1[] = [
                            "type"        => "MultiPolygon",
                            "type" => "Feature",
                            "geometry"    => array(
                                "type"        => $jenis,
                                "coordinates" => $lt,
                            ),
                            "id"          => $row_ppe_per->wilayah,
                            "properties"  => array(
                                "ID"   => 'Indonesia',
                                "target"   => (float)$row_ppe_per->target,
                                "t_m_rpjmn" => (float)$row_ppe_per->t_m_rpjmn,
                                "t_rkpd" => (float)$row_ppe_per->t_rkpd,
                                "t_k_rkp" => (float)$row_ppe_per->t_k_rkp,
                                "nasional"   => (float)$row_ppe_per->nasional,
                                "kode"      => $row_ppe_per->wilayah,
                                "NAME_2"    => $row_ppe_per->nama_provinsi,
                                "population" => (float)$row_ppe_per->nilai,
                                "satuan" => $row_ppe_per->satuan,
                                "periode" => $row_ppe_per->tahun,
                                "jenis" => $row_ppe_per->jenis,
                                "description" =>
                                '<strong style="padding: 0px;">' . $row_ppe_per->nama_provinsi . '</strong> (Periode : ' . $row_ppe_per->tahun . ')<hr style="margin: 2px;"/><b>Capaian</b> : ' . $population . '<br/><b>Target RKPD</b> : ' . (empty($target_t_rkpd) ? 'n/a' : $target_t_rkpd) . '<br/><b>Target RKP</b> : ' . (empty($target) ? 'n/a' : $target) . '<br/><b>Target Kewilayahan RKP</b> : ' . (empty($target_t_k_rkp) ? 'n/a' : $target_t_k_rkp) . '<br/><b>Capaian Nasional</b> : ' . $nasional,
                                "short_description" =>
                                '<strong style="padding: 0px;">' . $row_ppe_per->nama_provinsi . '</strong> (Periode : ' . $row_ppe_per->tahun . ')<hr style="margin: 2px;"/><b>Capaian ' . $nm_ind . '</b> : ' . $population,
                            ),
                        ];
                        $nilai_peta = $type1;
                    }
                    $thnmax = "SELECT MAX(tahun) AS thn,sumber,periode FROM nilai_indikator WHERE `wilayah`='1000' AND id_indikator = '" . $ind . "'";
                    $list_thn = $this->db2->query($thnmax);
                    foreach ($list_thn->result() as $Lis_thn) {
                        $periode                = $Lis_thn->periode;
                        if ($periode == '00') {
                            $thn = $Lis_thn->thn;
                        } else {
                            $thn =  $prde[$Lis_thn->periode] . " - " . $Lis_thn->thn;
                        }
                        $thn_a = $thn;
                        $datasumber     = "Sumber : " . $Lis_thn->sumber;
                    }
                    $js_zoom   = 3;
                    $js_tengah = [119.206479, -0.320152];
                } else if (($pro != '') && ($pro != '1000')) {

                    $catdata = array();

                    $sql_pro = "SELECT P.* FROM provinsi P WHERE P.`id`='" . $pro . "' ";
                    $list_data = $this->db2->query($sql_pro);
                    foreach ($list_data->result() as $Lis_pro) {
                        $xname = $Lis_pro->nama_provinsi;
                        $query = $Lis_pro->id;
                        $label_pe = $Lis_pro->label;
                    }
                    $sql = "SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $ind . "' AND wilayah='1000') AND periode !='01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $ind . "' AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC";
                    $list_data  = $this->db2->query($sql);
                    // var_dump($list_data->result_array());
                    // die();
                    foreach ($list_data->result() as $row) {
                        $id                     = $row->id;
                        $categories[]           = $bulan[$row->periode] . " " . $row->tahun;
                        $nilai[]                = (float)$row->nilai;
                        $periode                = $row->periode;
                        if ($periode == '00') {
                            $thn = $row->tahun;
                        } else {
                            $thn =  $prde[$row->periode] . " - " . $row->tahun;
                        }
                        // $thn_a = $thn;
                        $categories1[]   = $thn;
                    }
                    $tahun             = $categories1;
                    $nilaiData['name'] = "Indonesia";
                    $nilaiData['data'] = $nilai;
                    array_push($catdata, $nilaiData);

                    $sql_dpro = "SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $ind . "' AND wilayah='" . $query . "') AND periode !='01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $ind . "' AND wilayah='" . $query . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC";
                    $list_dpro  = $this->db2->query($sql_dpro);
                    foreach ($list_dpro->result() as $row_dpro) {
                        $nilainsl           = $xname . " " . $row_dpro->nilai;
                        $id_pro             = $row_dpro->id;
                        $categories_pro[]   = $row_dpro->tahun;
                        $nilai_pro[]        = (float)$row_dpro->nilai;
                        $periode_pe[]       = $row_dpro->id_periode;
                    }

                    $periode_pe_max = max($periode_pe);
                    $catdata_pro = array();
                    $perbandingan_pe = "select p.label as label,p.nama_provinsi, e.* 
                                        from provinsi p 
                                        join nilai_indikator e on p.id = e.wilayah
                                        where (e.id_indikator='" . $ind . "' AND e.id_periode='$periode_pe_max') 
                                        AND periode != '01'
                                        AND (wilayah, versi) in (select x.wilayah, max(x.versi) as versi 
                                from nilai_indikator x  
                                where id_indikator='" . $ind . "' AND id_periode='$periode_pe_max' 
                                group by wilayah) group by wilayah order by wilayah asc";
                    $list_ppe_per = $this->db2->query($perbandingan_pe);
                    foreach ($list_ppe_per->result() as $row_ppe_per) {
                        $label_ppe[]                               = $row_ppe_per->label;
                        $nilai_ppe_per[]                           = (float)$row_ppe_per->nilai;
                        $nilai_p_e_r1[$row_ppe_per->label]         = $row_ppe_per->nilai;
                        $nilai_p_e_r2[$row_ppe_per->nama_provinsi] = $row_ppe_per->nilai;
                    }

                    //perbandingan kab
                    $catdata_kab = array();
                    $th_p_kab = "select max(e.id_periode) AS perio from kabupaten p join nilai_indikator e on p.id = e.wilayah where p.prov_id='" . $query . "' AND e.id_indikator='" . $ind . "'";
                    $t_list_kab_pe = $this->db2->query($th_p_kab);
                    foreach ($t_list_kab_pe->result() as $row_t_pe_kab) {
                        $perio = $row_t_pe_kab->perio;
                    }
                    $ppe_kab = "select p.nama_kabupaten as label,p.prov_id, i.jenis, e.* 
                                from kabupaten p
                                join nilai_indikator e on p.id = e.wilayah 
                                join indikator i on i.id = e.id_indikator 
                                where p.prov_id='" . $query . "' and (e.id_indikator='" . $ind . "' AND e.id_periode='" . $perio . "') AND periode != '01' AND (wilayah, versi) in (
                                   select x.wilayah, max(x.versi) as versi from nilai_indikator x  where id_indikator='" . $ind . "' AND id_periode='" . $perio . "' group by wilayah ) 
                               group by wilayah order by wilayah asc";

                    $ppe_prov_in_kab = "select p.label as label,p.nama_provinsi, i.jenis, e.* 
                                from provinsi p 
                                join nilai_indikator e on p.id = e.wilayah 
                                join indikator i on i.id = e.id_indikator 
                                where p.id='" . $query . "' and (e.id_indikator='" . $ind . "' AND e.id_periode='" . $perio . "') AND periode != '01' AND (wilayah, versi) in (
                                    select x.wilayah, max(x.versi) as versi from nilai_indikator x where id_indikator='" . $ind . "' AND id_periode='" . $perio . "' group by wilayah ) 
                                group by wilayah order by wilayah asc";

                    $list_prov_in_kab_ppe_per = $this->db2->query($ppe_prov_in_kab)->result();
                    $list_kab_ppe_per = $this->db2->query($ppe_kab);
                    foreach ($list_kab_ppe_per->result() as $row_ppe_kab_per) {
                        $nilai_ppe_per_kab[] = $row_ppe_kab_per->nilai;
                        $posisi_ppe          = strpos($row_ppe_kab_per->label, "Kabupaten");
                        if ($posisi_ppe !== FALSE) {
                            $label_ppe11 = substr($row_ppe_kab_per->label, 0, 3) . ". " . substr($row_ppe_kab_per->label, 10);
                        } else {
                            $label_ppe11 = $row_ppe_kab_per->label;
                        }
                        $label_pek1[] = $label_ppe11;
                        $label_pe1_k[$label_ppe11] = $row_ppe_kab_per->nilai;
                        $nilai_ppe_kab[]                           = (float)$row_ppe_kab_per->nilai;
                        $idwill = $row_ppe_kab_per->wilayah;
                        $idpro = $row_ppe_kab_per->prov_id;
                        if ($idpro == '3100' || $idpro == '3200' || $idpro == '3300' || $idpro == '3400' || $idpro == '3500' || $idpro == '3600') {
                            $lt = nama_jawa($idwill);
                        } else if ($idpro == '5100' || $idpro == '5200' || $idpro == '5300') {
                            $lt = nama_wilayah3($idwill);
                        }
                        //kalimantan
                        else if ($idpro == '6100' || $idpro == '6200' || $idpro == '6300' || $idpro == '6400' || $idpro == '6500') {
                            $lt = nama_wilayah4($idwill);
                        }
                        //sulawes
                        else if ($idpro == '7100' || $idpro == '7200' || $idpro == '7300' || $idpro == '7400' || $idpro == '7500' || $idpro == '7600') {
                            $lt = nama_wilayah5($idwill);
                        } else if ($idpro == '8100' || $idpro == '8200' || $idpro == '9100' || $idpro == '9400') {
                            $lt = nama_wilayah6($idwill);
                        } else {
                            $lt = nama_wilayah($idwill);
                        }
                        // ubah format nilai
                        if ($row_ppe_kab_per->satuan == '%') {
                            $target_kab = round((float)$row_ppe_kab_per->target, 2);
                            $target_t_m_rpjmn_kab = round((float)$row_ppe_kab_per->t_m_rpjmn, 2);
                            $target_t_rkpd_kab = round((float)$row_ppe_kab_per->t_rkpd, 2);
                            $target_t_k_rkp_kab = round((float)$row_ppe_kab_per->t_k_rkp, 2);
                            $nasional_kab = round((float)$row_ppe_kab_per->nasional, 2);
                            $provinsi_kab = round((float)$list_prov_in_kab_ppe_per[0]->nilai, 2);
                            $population_kab = round((float)$row_ppe_kab_per->nilai, 2);
                        } elseif ($row_ppe_kab_per->satuan == 'Rp') {
                            $target_kab = number_format((float)$row_ppe_kab_per->target, 0, ',', '.');
                            $target_t_m_rpjmn_kab = number_format((float)$row_ppe_kab_per->t_m_rpjmn, 0, ',', '.');
                            $target_t_rkpd_kab = number_format((float)$row_ppe_kab_per->t_rkpd, 0, ',', '.');
                            $target_t_k_rkp_kab = number_format((float)$row_ppe_kab_per->t_k_rkp, 0, ',', '.');
                            $nasional_kab = number_format((float)$row_ppe_kab_per->nasional, 0, ',', '.');
                            $provinsi_kab = number_format((float)$list_prov_in_kab_ppe_per[0]->nilai, 0, ',', '.');
                            $population_kab = number_format((float)$row_ppe_kab_per->nilai, 0, ',', '.');
                        } elseif ($row_ppe_kab_per->satuan == 'Orang') {
                            $target_kab = number_format((float)$row_ppe_kab_per->target, 0, ',', '.');
                            $target_t_m_rpjmn_kab = number_format((float)$row_ppe_kab_per->t_m_rpjmn, 0, ',', '.');
                            $target_t_rkpd_kab = number_format((float)$row_ppe_kab_per->t_rkpd, 0, ',', '.');
                            $target_t_k_rkp_kab = number_format((float)$row_ppe_kab_per->t_k_rkp, 0, ',', '.');
                            $nasional_kab = number_format((float)$row_ppe_kab_per->nasional, 0, ',', '.');
                            $provinsi_kab = number_format((float)$list_prov_in_kab_ppe_per[0]->nilai, 0, ',', '.');
                            $population_kab = number_format((float)$row_ppe_kab_per->nilai, 0, ',', '.');
                        } else {
                            $target_kab = (float)$row_ppe_kab_per->target;
                            $target_t_m_rpjmn_kab = (float)$row_ppe_kab_per->t_m_rpjmn;
                            $target_t_rkpd_kab = (float)$row_ppe_kab_per->t_rkpd;
                            $target_t_k_rkp_kab = (float)$row_ppe_kab_per->t_k_rkp;
                            $nasional_kab = (float)$row_ppe_kab_per->nasional;
                            $provinsi_kab = (float)$list_prov_in_kab_ppe_per[0]->nilai;
                            $population_kab = (float)$row_ppe_kab_per->nilai;
                        }
                        // end ubah format nilai
                        $type[] = [
                            "type"        => "MultiPolygon",
                            "type" => "Feature",
                            "geometry"    => array(
                                "type"        => 'MultiPolygon',
                                "coordinates" => $lt,
                            ),
                            "id"          => $row_ppe_kab_per->wilayah,
                            "properties"  => array(
                                "ID"   => 'Indonesia',
                                "target"    => (float)$row_ppe_kab_per->target,
                                "t_m_rpjmn"    => (float)$row_ppe_kab_per->t_m_rpjmn,
                                "t_rkpd"    => (float)$row_ppe_kab_per->t_rkpd,
                                "t_k_rkp"    => (float)$row_ppe_kab_per->t_k_rkp,
                                "nasional"  => (float)$row_ppe_kab_per->nasional,
                                "kode"      => $row_ppe_kab_per->wilayah,
                                "NAME_2"    => $label_ppe11,
                                "population" => (float)$row_ppe_kab_per->nilai,
                                "satuan" => $row_ppe_kab_per->satuan,
                                "periode" => $row_ppe_kab_per->tahun,
                                "jenis" => $row_ppe_kab_per->jenis,
                                "nilai_provinsi" => (float)$list_prov_in_kab_ppe_per[0]->nilai,
                                "regional_targeted" => $kabkot,
                                "province_targeted" => $pro,
                                "description" =>
                                // '<strong style="padding: 0px;">' . $label_ppe11 . '</strong> (Periode : ' . $row_ppe_kab_per->tahun . ')<hr style="margin-top: 5px; margin-bottom: 5px;"/><b>Capaian ' . $nm_ind . '</b> : ' . $population_kab . '<br/><b>Target m RPJMN</b> : ' . $target_t_m_rpjmn_kab . '<br/><b>Target RKPD</b> : ' . $target_t_rkpd_kab . '<br/><b>Target k RKP</b> : ' . $target_t_k_rkp_kab . '<br/><b>Capaian Nasional</b> : ' . $nasional_kab,
                                '<strong style="padding: 0px;">' . $label_ppe11 . '</strong> (Periode : ' . $row_ppe_kab_per->tahun . ')<hr style="margin-top: 5px; margin-bottom: 5px;"/><b>Capaian ' . $nm_ind . '</b> : ' . $population_kab . '<br/><b>Capaian ' . $list_prov_in_kab_ppe_per[0]->nama_provinsi . '</b> : ' . $provinsi_kab . '<br/><b>Capaian Nasional</b> : ' . $nasional_kab,
                                "short_description" =>
                                '<strong style="padding: 0px;">' . $label_ppe11 . '</strong> (Periode : ' . $row_ppe_kab_per->tahun . ')<hr style="margin-top: 5px; margin-bottom: 5px;"/><b>Capaian ' . $nm_ind . '</b> : ' . $population_kab,
                            ),
                        ];
                        $nilai_peta = $type;
                    }
                    $thnmax = "SELECT MAX(tahun) AS thn,sumber, periode FROM nilai_indikator WHERE `wilayah`='" . $query . "' AND id_indikator = '" . $ind . "'";
                    $list_thn = $this->db2->query($thnmax);
                    foreach ($list_thn->result() as $Lis_thn) {
                        $periode                = $Lis_thn->periode;
                        if ($periode == '00') {
                            $thn = $Lis_thn->thn;
                        } else {
                            $thn =  $prde[$Lis_thn->periode] . " - " . $Lis_thn->thn;
                        }
                        $thn_a      = $thn;
                        $datasumber = "Sumber : " . $Lis_thn->sumber;
                    }

                    //$this->js_geo    = "assets/js/geojson/indonesia-" . $query . ".geojson";
                    if ($pro == '3100') {
                        $js_zoom = 9;
                    } else {
                        $js_zoom = 5;
                    }
                    $js_tengah = $posisi[$query];
                    $properties = 'NAME_1';
                } else if (($pro != '') && ($pro != '1000') && ($kabkot != '')) {
                    $catdata = array();

                    $sql_pro = "SELECT P.* FROM provinsi P WHERE P.`id`='" . $pro . "' ";
                    $list_data = $this->db2->query($sql_pro);
                    foreach ($list_data->result() as $Lis_pro) {
                        $xname = $Lis_pro->nama_provinsi;
                        $query = $Lis_pro->id;
                        $label_pe = $Lis_pro->label;
                    }
                    $sql = "SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $ind . "' AND wilayah='1000') AND periode !='01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $ind . "' AND wilayah='1000' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC";
                    $list_data  = $this->db2->query($sql);
                    // var_dump($list_data->result_array());
                    // die();
                    foreach ($list_data->result() as $row) {
                        $id                     = $row->id;
                        $categories[]           = $bulan[$row->periode] . " " . $row->tahun;
                        $nilai[]                = (float)$row->nilai;
                        $periode                = $row->periode;
                        if ($periode == '00') {
                            $thn = $row->tahun;
                        } else {
                            $thn =  $prde[$row->periode] . " - " . $row->tahun;
                        }
                        // $thn_a = $thn;
                        $categories1[]   = $thn;
                    }
                    $tahun             = $categories1;
                    $nilaiData['name'] = "Indonesia";
                    $nilaiData['data'] = $nilai;
                    array_push($catdata, $nilaiData);

                    $sql_dpro = "SELECT * FROM (select * from nilai_indikator where (id_indikator='" . $ind . "' AND wilayah='" . $query . "') AND periode !='01' AND (id_periode, versi) in (select id_periode, max(versi) as versi from nilai_indikator WHERE id_indikator='" . $ind . "' AND wilayah='" . $query . "' group by id_periode) group by id_periode order by id_periode desc limit 6) y order by id_periode ASC";
                    $list_dpro  = $this->db2->query($sql_dpro);
                    foreach ($list_dpro->result() as $row_dpro) {
                        $nilainsl           = $xname . " " . $row_dpro->nilai;
                        $id_pro             = $row_dpro->id;
                        $categories_pro[]   = $row_dpro->tahun;
                        $nilai_pro[]        = (float)$row_dpro->nilai;
                        $periode_pe[]       = $row_dpro->id_periode;
                    }

                    $periode_pe_max = max($periode_pe);
                    $catdata_pro = array();
                    $perbandingan_pe = "select p.label as label,p.nama_provinsi, e.* 
                                        from provinsi p 
                                        join nilai_indikator e on p.id = e.wilayah
                                        where (e.id_indikator='" . $ind . "' AND e.id_periode='$periode_pe_max') 
                                        AND periode != '01'
                                        AND (wilayah, versi) in (select x.wilayah, max(x.versi) as versi 
                                from nilai_indikator x  
                                where id_indikator='" . $ind . "' AND id_periode='$periode_pe_max' 
                                group by wilayah) group by wilayah order by wilayah asc";
                    $list_ppe_per = $this->db2->query($perbandingan_pe);
                    foreach ($list_ppe_per->result() as $row_ppe_per) {
                        $label_ppe[]                               = $row_ppe_per->label;
                        $nilai_ppe_per[]                           = (float)$row_ppe_per->nilai;
                        $nilai_p_e_r1[$row_ppe_per->label]         = $row_ppe_per->nilai;
                        $nilai_p_e_r2[$row_ppe_per->nama_provinsi] = $row_ppe_per->nilai;
                    }

                    //perbandingan kab
                    $catdata_kab = array();
                    $th_p_kab = "select max(e.id_periode) AS perio from kabupaten p join nilai_indikator e on p.id = e.wilayah where p.prov_id='" . $query . "' AND e.id_indikator='" . $ind . "'";
                    $t_list_kab_pe = $this->db2->query($th_p_kab);
                    foreach ($t_list_kab_pe->result() as $row_t_pe_kab) {
                        $perio = $row_t_pe_kab->perio;
                    }
                    $ppe_kab = "select p.nama_kabupaten as label,p.prov_id, i.jenis, e.* 
                                from kabupaten p
                                join nilai_indikator e on p.id = e.wilayah 
                                join indikator i on i.id = e.id_indikator 
                                where p.prov_id='" . $query . "' and (e.id_indikator='" . $ind . "' AND e.id_periode='" . $perio . "') AND periode != '01' AND (wilayah, versi) in (
                                   select x.wilayah, max(x.versi) as versi from nilai_indikator x  where id_indikator='" . $ind . "' AND id_periode='" . $perio . "' group by wilayah ) 
                               group by wilayah order by wilayah asc";

                    $ppe_prov_in_kab = "select p.label as label,p.nama_provinsi, i.jenis, e.* 
                                from provinsi p 
                                join nilai_indikator e on p.id = e.wilayah 
                                join indikator i on i.id = e.id_indikator 
                                where p.id='" . $query . "' and (e.id_indikator='" . $ind . "' AND e.id_periode='" . $perio . "') AND periode != '01' AND (wilayah, versi) in (
                                    select x.wilayah, max(x.versi) as versi from nilai_indikator x where id_indikator='" . $ind . "' AND id_periode='" . $perio . "' group by wilayah ) 
                                group by wilayah order by wilayah asc";

                    $list_prov_in_kab_ppe_per = $this->db2->query($ppe_prov_in_kab)->result();
                    $list_kab_ppe_per = $this->db2->query($ppe_kab);
                    foreach ($list_kab_ppe_per->result() as $row_ppe_kab_per) {
                        $nilai_ppe_per_kab[] = $row_ppe_kab_per->nilai;
                        $posisi_ppe          = strpos($row_ppe_kab_per->label, "Kabupaten");
                        if ($posisi_ppe !== FALSE) {
                            $label_ppe11 = substr($row_ppe_kab_per->label, 0, 3) . ". " . substr($row_ppe_kab_per->label, 10);
                        } else {
                            $label_ppe11 = $row_ppe_kab_per->label;
                        }
                        $label_pek1[] = $label_ppe11;
                        $label_pe1_k[$label_ppe11] = $row_ppe_kab_per->nilai;
                        $nilai_ppe_kab[]                           = (float)$row_ppe_kab_per->nilai;
                        $idwill = $row_ppe_kab_per->wilayah;
                        $idpro = $row_ppe_kab_per->prov_id;
                        if ($idpro == '3100' || $idpro == '3200' || $idpro == '3300' || $idpro == '3400' || $idpro == '3500' || $idpro == '3600') {
                            $lt = nama_jawa($idwill);
                        } else if ($idpro == '5100' || $idpro == '5200' || $idpro == '5300') {
                            $lt = nama_wilayah3($idwill);
                        }
                        //kalimantan
                        else if ($idpro == '6100' || $idpro == '6200' || $idpro == '6300' || $idpro == '6400' || $idpro == '6500') {
                            $lt = nama_wilayah4($idwill);
                        }
                        //sulawes
                        else if ($idpro == '7100' || $idpro == '7200' || $idpro == '7300' || $idpro == '7400' || $idpro == '7500' || $idpro == '7600') {
                            $lt = nama_wilayah5($idwill);
                        } else if ($idpro == '8100' || $idpro == '8200' || $idpro == '9100' || $idpro == '9400') {
                            $lt = nama_wilayah6($idwill);
                        } else {
                            $lt = nama_wilayah($idwill);
                        }
                        // ubah format nilai
                        if ($row_ppe_kab_per->satuan == '%') {
                            $target_kab = round((float)$row_ppe_kab_per->target, 2);
                            $target_t_m_rpjmn_kab = round((float)$row_ppe_kab_per->t_m_rpjmn, 2);
                            $target_t_rkpd_kab = round((float)$row_ppe_kab_per->t_rkpd, 2);
                            $target_t_k_rkp_kab = round((float)$row_ppe_kab_per->t_k_rkp, 2);
                            $nasional_kab = round((float)$row_ppe_kab_per->nasional, 2);
                            $provinsi_kab = round((float)$list_prov_in_kab_ppe_per[0]->nilai, 2);
                            $population_kab = round((float)$row_ppe_kab_per->nilai, 2);
                        } elseif ($row_ppe_kab_per->satuan == 'Rp') {
                            $target_kab = number_format((float)$row_ppe_kab_per->target, 0, ',', '.');
                            $target_t_m_rpjmn_kab = number_format((float)$row_ppe_kab_per->t_m_rpjmn, 0, ',', '.');
                            $target_t_rkpd_kab = number_format((float)$row_ppe_kab_per->t_rkpd, 0, ',', '.');
                            $target_t_k_rkp_kab = number_format((float)$row_ppe_kab_per->t_k_rkp, 0, ',', '.');
                            $nasional_kab = number_format((float)$row_ppe_kab_per->nasional, 0, ',', '.');
                            $provinsi_kab = number_format((float)$list_prov_in_kab_ppe_per[0]->nilai, 0, ',', '.');
                            $population_kab = number_format((float)$row_ppe_kab_per->nilai, 0, ',', '.');
                        } elseif ($row_ppe_kab_per->satuan == 'Orang') {
                            $target_kab = number_format((float)$row_ppe_kab_per->target, 0, ',', '.');
                            $target_t_m_rpjmn_kab = number_format((float)$row_ppe_kab_per->t_m_rpjmn, 0, ',', '.');
                            $target_t_rkpd_kab = number_format((float)$row_ppe_kab_per->t_rkpd, 0, ',', '.');
                            $target_t_k_rkp_kab = number_format((float)$row_ppe_kab_per->t_k_rkp, 0, ',', '.');
                            $nasional_kab = number_format((float)$row_ppe_kab_per->nasional, 0, ',', '.');
                            $provinsi_kab = number_format((float)$list_prov_in_kab_ppe_per[0]->nilai, 0, ',', '.');
                            $population_kab = number_format((float)$row_ppe_kab_per->nilai, 0, ',', '.');
                        } else {
                            $target_kab = (float)$row_ppe_kab_per->target;
                            $target_t_m_rpjmn_kab = (float)$row_ppe_kab_per->t_m_rpjmn;
                            $target_t_rkpd_kab = (float)$row_ppe_kab_per->t_rkpd;
                            $target_t_k_rkp_kab = (float)$row_ppe_kab_per->t_k_rkp;
                            $nasional_kab = (float)$row_ppe_kab_per->nasional;
                            $provinsi_kab = (float)$list_prov_in_kab_ppe_per[0]->nilai;
                            $population_kab = (float)$row_ppe_kab_per->nilai;
                        }
                        // end ubah format nilai
                        $type[] = [
                            "type"        => "MultiPolygon",
                            "type" => "Feature",
                            "geometry"    => array(
                                "type"        => 'MultiPolygon',
                                "coordinates" => $lt,
                            ),
                            "id"          => $row_ppe_kab_per->wilayah,
                            "properties"  => array(
                                "ID"   => 'Indonesia',
                                "target"    => (float)$row_ppe_kab_per->target,
                                "t_m_rpjmn"    => (float)$row_ppe_kab_per->t_m_rpjmn,
                                "t_rkpd"    => (float)$row_ppe_kab_per->t_rkpd,
                                "t_k_rkp"    => (float)$row_ppe_kab_per->t_k_rkp,
                                "nasional"  => (float)$row_ppe_kab_per->nasional,
                                "kode"      => $row_ppe_kab_per->wilayah,
                                "NAME_2"    => $label_ppe11,
                                "population" => (float)$row_ppe_kab_per->nilai,
                                "satuan" => $row_ppe_kab_per->satuan,
                                "periode" => $row_ppe_kab_per->tahun,
                                "jenis" => $row_ppe_kab_per->jenis,
                                "nilai_provinsi" => (float)$list_prov_in_kab_ppe_per[0]->nilai,
                                "regional_targeted" => $kabkot,
                                "province_targeted" => $pro,
                                "description" =>
                                // '<strong style="padding: 0px;">' . $label_ppe11 . '</strong> (Periode : ' . $row_ppe_kab_per->tahun . ')<hr style="margin-top: 5px; margin-bottom: 5px;"/><b>Capaian ' . $nm_ind . '</b> : ' . $population_kab . '<br/><b>Target m RPJMN</b> : ' . $target_t_m_rpjmn_kab . '<br/><b>Target RKPD</b> : ' . $target_t_rkpd_kab . '<br/><b>Target k RKP</b> : ' . $target_t_k_rkp_kab . '<br/><b>Capaian Nasional</b> : ' . $nasional_kab,
                                '<strong style="padding: 0px;">' . $label_ppe11 . '</strong> (Periode : ' . $row_ppe_kab_per->tahun . ')<hr style="margin-top: 5px; margin-bottom: 5px;"/><b>Capaian ' . $nm_ind . '</b> : ' . $population_kab . '<br/><b>Capaian ' . $list_prov_in_kab_ppe_per[0]->nama_provinsi . '</b> : ' . $provinsi_kab . '<br/><b>Capaian Nasional</b> : ' . $nasional_kab,
                                "short_description" =>
                                '<strong style="padding: 0px;">' . $label_ppe11 . '</strong> (Periode : ' . $row_ppe_kab_per->tahun . ')<hr style="margin-top: 5px; margin-bottom: 5px;"/><b>Capaian ' . $nm_ind . '</b> : ' . $population_kab,
                            ),
                        ];
                        $nilai_peta = $type;
                    }
                    $thnmax = "SELECT MAX(tahun) AS thn,sumber, periode FROM nilai_indikator WHERE `wilayah`='" . $query . "' AND id_indikator = '" . $ind . "'";
                    $list_thn = $this->db2->query($thnmax);
                    foreach ($list_thn->result() as $Lis_thn) {
                        $periode                = $Lis_thn->periode;
                        if ($periode == '00') {
                            $thn = $Lis_thn->thn;
                        } else {
                            $thn =  $prde[$Lis_thn->periode] . " - " . $Lis_thn->thn;
                        }
                        $thn_a      = $thn;
                        $datasumber = "Sumber : " . $Lis_thn->sumber;
                    }

                    //$this->js_geo    = "assets/js/geojson/indonesia-" . $query . ".geojson";
                    if ($pro == '3100') {
                        $js_zoom = 9;
                    } else {
                        $js_zoom = 5;
                    }
                    $js_tengah = $posisi[$query];
                    $properties = 'NAME_1';
                };

                $json_data = array(
                    "tahun_a"    => $thn_a,
                    "nasional" => $nilainsl,
                    "peta" => [
                        "type" => "FeatureCollection",
                        //   "features"=> [["type"=>$type]]
                        "features" => $nilai_peta
                    ],
                    //"js_geo"   => base_url($this->js_geo),
                    "js_zoom"  => $js_zoom,
                    "js_tengah"  => $js_tengah,

                    "text"       => $title,
                );
                exit(json_encode($json_data));
            } catch (Exception $exc) {
                $json_data = array(
                    "text"           => "",
                    "categories"     => "",
                    "series"         => 0
                );
                exit(json_encode($json_data));
            }
        } else
            die;
    }
}
