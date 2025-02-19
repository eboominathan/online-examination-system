<!-- Modal For Add Question -->
<div class="modal fade" id="modalForAddQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form class="refreshFrm" id="addQuestionFrm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Question for <br><?php echo $selExamRow['ex_title']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <input type="hidden" name="examId" value="<?php echo $exId; ?>">
            <div class="form-group">
              <label>Question</label>
              <input type="text" name="question" class="form-control" placeholder="Input question" autocomplete="off" required>
            </div>
            
            <fieldset>
              <legend>Input choices with marks and descriptions</legend>
              
              <?php 
              $choices = ['A', 'B', 'C', 'D'];
              foreach ($choices as $choice) { ?>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-4">
                      <label>Choice <?php echo $choice; ?></label>
                      <input type="text" name="choice_<?php echo $choice; ?>" class="form-control" placeholder="Input choice <?php echo $choice; ?>" autocomplete="off" required>
                    </div>
                    <div class="col-md-4">
                      <label>Mark</label>
                      <input type="number" name="mark_<?php echo $choice; ?>" class="form-control" placeholder="Mark for <?php echo $choice; ?>" autocomplete="off" required>
                    </div>
                    <div class="col-md-4">
                      <label>Description</label>
                      <input type="text" name="desc_<?php echo $choice; ?>" class="form-control" placeholder="Description for <?php echo $choice; ?>" autocomplete="off" required>
                    </div>
                  </div>
                </div>
              <?php } ?>
              
              <div class="form-group">
                <label>Correct Answer</label>
                <select name="correctAnswer" class="form-control" required>
                  <option value="">Select correct answer</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Now</button>
        </div>
      </div>
    </form>
  </div>
</div>