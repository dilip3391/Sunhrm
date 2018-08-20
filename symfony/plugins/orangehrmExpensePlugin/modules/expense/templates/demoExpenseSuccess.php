<?php 
 use_stylesheets_for_form($form); 
?>
<div class="box toggableForm">
    <div class="head">
        <h1><?php echo __("Expense Module"); ?></h1>
    </div>
   <div class="inner">
 
    
<form id="Expense" class = "Expense" method="post" action="<?php echo url_for('expense/demoExpense'); ?>" 
              enctype="multipart/form-data">
              <fieldset>
                <ol>
                        <?php echo $form->render(); ?>
                </ol>
                <p>
                    <?php
                    $searchActionButtons = $form->getSearchActionButtons();
                    foreach ($searchActionButtons as $id => $button) {
                        echo $button->render($id), "\n";
                    }
                    ?> 
                </p>
            </fieldset>
    </form>

</div>

