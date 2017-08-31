<?php
/**
  * @var \App\View\AppV=iew $this

  */
pr($challenge);
?>
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-content">
				<div class="challenges form large-9 medium-8 columns content">
    <?= $this->Form->create($challenge) ?>
    <fieldset>
        <div class = 'ibox-title'>
            <legend><?= __('Edit Challenge') ?></legend>
        </div>
        <!-- <?php
            echo $this->Form->control('challenge_type_id', ['options' => $challengeTypes]);
            echo $this->Form->control('name');
            echo $this->Form->control('details');
            echo $this->Form->control('response');
            echo $this->Form->control('is_active');
        ?> -->
        <input type = "hidden" value="<?=$challenge->challenge_type_id?>" name='ch-type' id='ch-type'/>
        <?php
                            echo $this->Form->control('name');
                            echo $this->Form->control('challenge_type_id', ['options' => $challengeTypes, 'empty' => '---Please Select---']);
                            ?>
                        <div id = "read-article" >
                            <?php
                                $question_type = [
                                                    'Multiple Choice' => 'Multiple Choice',
                                                    'One-Word' => 'One-Word'
                                                 ];

                                echo $this->Form->control('details.question_type', ['options' => $question_type, 'empty' => '---Please Select---']);
                                ?>
                                <div class="form-group text">
                                    <label class="col-sm-2 control-label" for="details-statement">
                                        Statement
                                    </label>
                                    <div class="col-sm-7">
                                        <div class="form-group text">
                                            <input type="text" class="form-control" name="details[statement]" id="details-statement" value = '<?= $challenge->details['statement']?>'>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" id = "multiple" >
                                        <button class= 'form-control btn btn-success' id = 'add_option' style = "width: 140px;background: #1c84c6; color: white; border-radius: 5px;">Add Option</button>
                                    </div>
                                </div>
                                <?php foreach ($challenge->details['option'] as $key => $value):?>
                                    
                                <div class="form-group text" id = "optionData">
                                    <label class="col-sm-2 control-label" for="details-statement">
                                        <?php 
                                            $x = $key+1;
                                            echo "Option ".$x;
                                        ?>
                                    </label>
                                    <div class="col-sm-7">
                                        <div class="form-group text">
                                            <input type="text" class="form-control" name="details[option][<?= $key ?>]" id="details-option" value = "<?= $value ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <div id="option"></div>     
                         </div>
                            <div id='fill-in-blanks'>         
                            <?php
                                echo $this->Form->control('details.link');
                                echo $this->Form->control('response');
                            ?>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->label('is_active', __('Active'), ['class' => ['col-sm-2', 'control-label'], 'id' => 'is_active']) ?>
                                <?= $this->Form->checkbox('is_active', ['label' => false, 'class' => ['form-control']]); ?>
                            </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

			</div> <!-- .ibox-content ends --> 
		</div> <!-- .ibox ends -->
	</div> <!-- .col-lg-12 ends -->
</div> <!-- .row ends -->

<script type="text/javascript">

$(document).ready(function(){
    toggleElements($('#ch-type').val());    
});

function toggleElements(chVal){
    console.log(chVal);
    if(chVal == 1){
        document.getElementById('read-article').style.display = 'block';
        document.getElementById('fill-in-blanks').style.display = 'block';
    }
    if(chVal == 2 || chVal == 3){
        document.getElementById('read-article').style.display = 'none';
        document.getElementById('fill-in-blanks').style.display = 'none';
    }
    if(chVal == 4 || chVal == 5){
        document.getElementById('read-article').style.display = 'block';
        document.getElementById('fill-in-blanks').style.display = 'none';
    }
    document.getElementById('multiple').style.display = 'none';
    document.getElementById('optionData').style.display = 'none';
}
$(document).on('change', 'select', function() {
    console.log($(this).val()); // the selected options’s value
    toggleElements($(this).val());
    if($(this).val() == "Multiple Choice"){
        document.getElementById('multiple').style.display = 'block';
        document.getElementById('optionData').style.display = 'block';
    }
    else if($(this).val() == "One-Word"){
        document.getElementById('multiple').style.display = 'none';
        document.getElementById('optionData').style.display = 'none';
    }
});

$(document).ready(function() {
    var wrapper         = $("#option"); //Fields wrapper
    var add_button      = $("#add_option"); //Add button ID
    
    var x = <?php echo count($challenge->details['option']);?>; //initlal text box count
    // alert(x);
    var y = x + 1;
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
            $(wrapper).append('<div class="form-group text"><label class="col-sm-3 control-label" for="details-statement" style = "margin-left:1px; padding-right: 96px;">Option '+y+'</label><div class="col-sm-7"><div class="form-group text"><input type="text" class="form-control" name="details[option]['+x+']" id="details-option" style = "margin-left: -81px;"></div></div></div>');
                x++; //text box increment
                y++;
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').parent('label').remove(); x--;
    })
});
</script>