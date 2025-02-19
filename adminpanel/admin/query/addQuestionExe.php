<?php 
include("../../../conn.php");

extract($_POST);

$selQuest = $conn->prepare("SELECT * FROM exam_question_tbl WHERE exam_id = ? AND exam_question = ?");
$selQuest->execute([$examId, $question]);

if ($selQuest->rowCount() > 0) {
    $res = array("res" => "exist", "msg" => $question);
} else {
    $insQuest = $conn->prepare("
        INSERT INTO exam_question_tbl (
            exam_id, exam_question, 
            exam_ch1, exam_ch1_mark, exam_ch1_desc, 
            exam_ch2, exam_ch2_mark, exam_ch2_desc, 
            exam_ch3, exam_ch3_mark, exam_ch3_desc, 
            exam_ch4, exam_ch4_mark, exam_ch4_desc, 
            exam_answer
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $insertSuccess = $insQuest->execute([
        $examId, $question, 
        $choice_A, $mark_A, $desc_A, 
        $choice_B, $mark_B, $desc_B, 
        $choice_C, $mark_C, $desc_C, 
        $choice_D, $mark_D, $desc_D, 
        $correctAnswer
    ]);

    if ($insertSuccess) {
        $res = array("res" => "success", "msg" => $question);
    } else {
        $res = array("res" => "failed");
    }
}

echo json_encode($res);
?>
