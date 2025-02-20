<?php
session_start();

if (!isset($_SESSION['admin']['adminnakalogin']) == true) header("location:index.php");


?>
<?php include("../../conn.php"); ?>
<!-- MAO NI ANG HEADER -->
<?php include("includes/header.php"); ?>

<!-- UI THEME DIRI -->
<?php include("includes/ui-theme.php"); ?>

<div class="app-main">
    <!-- sidebar diri  -->
    <?php include("includes/sidebar.php"); ?>

    <link rel="stylesheet" type="text/css" href="css/mycss.css">
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>EXAMINEE RESULT</div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Examinee Result
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover"
                            id="tableList">
                            <thead>
                                <tr>
                                    <th>Sno</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Mark</th>
                                    <th>Description</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $examinee_id = intval($_GET['id']); // Sanitize input
                                $selExmne = $conn->query("
                                SELECT * 
                                FROM exam_answers AS ea
                                INNER JOIN exam_question_tbl AS eq 
                                ON eq.eqt_id = ea.quest_id  
                                WHERE ea.axmne_id = $examinee_id 
                                ORDER BY ea.exans_id DESC
                            ");

                                if ($selExmne->rowCount() > 0) {
                                    $i = 1;
                                    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) {
                                        // print_r($selExmneRow);
                                        $data = getMarkDesc($selExmneRow);
                                        echo '<tr>
                                        <td>' . $i++ . '</td>
                                        <td>' . $selExmneRow['exam_question'] . '</td>
                                        <td>' . $selExmneRow['exans_answer'] . '</td>
                                        <td>' . $data['mark'] . '</td>
                                        <td>' . $data['desc'] . '</td>
                                        </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
function getMarkDesc($array)
{
    $mapping = [
        'A' => ['mark' => 'exam_ch1_mark', 'desc' => 'exam_ch1_desc'],
        'B' => ['mark' => 'exam_ch2_mark', 'desc' => 'exam_ch2_desc'],
        'C' => ['mark' => 'exam_ch3_mark', 'desc' => 'exam_ch3_desc'],
        'D' => ['mark' => 'exam_ch4_mark', 'desc' => 'exam_ch4_desc'],
    ];
    if ($array['exans_answer'] == $array['exam_ch1_mark']) {
        $choice = 'A';
    }
    if ($array['exans_answer'] == $array['exam_ch2_mark']) {
        $choice = 'B';
    }
    if ($array['exans_answer'] == $array['exam_ch3_mark']) {
        $choice = 'C';
    }
    if ($array['exans_answer'] == $array['exam_ch4_mark']) {
        $choice = 'D';
    }

    if (isset($mapping[$choice])) {
        return [
            'mark' => $array[$mapping[$choice]['mark']],
            'desc' => $array[$mapping[$choice]['desc']]
        ];
    }

    return ['mark' => 0, 'desc' => ''];
}

?>