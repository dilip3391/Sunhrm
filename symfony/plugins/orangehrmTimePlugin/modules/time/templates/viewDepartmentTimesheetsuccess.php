<?php if($timesheetPermissions->canRead()){ ?>
<div class="box">
    <div class="head">
        <h1><?php echo __("Select Department"); ?></h1>
    </div>
    <div class="inner">
        <form action="<?php echo url_for("time/viewDepartmentTimesheet"); ?>" id="departmentSelectForm" 
              name="departmentSelectForm" method="post">
                  <?php echo $form->renderHiddenFields(); ?>
            <fieldset>
                <ol>
                    <li>
                        <?php echo $form['sub_unit']->renderLabel(__('Department Name')); ?>
                        <?php echo $form['sub_unit']->render(); ?>
                    </li>
                </ol>
                <p>
                    <input type="button" class="" id="btnSearch" value="<?php echo __('Search') ?>" />
                    <input type="button" class="reset" id="resetBtn" value="<?php echo __("Reset") ?>" name="_reset" />                    
                </p>
            </fieldset>
        </form>
    </div>
</div>

<!-- Employee-pending-submited-timesheets -->
<?php if (!($pendingApprovelTimesheets == null)): ?>
    <div class="box ">
        <div class="head">
            <h1><?php echo __("Timesheets Pending Action"); ?></h1>
        </div>
        <div class="inner">
            <form action="<?php echo url_for("time/viewDepartmentTimesheet"); ?>" id="viewTimesheetForm" method="post" >        
                <table class="table">
                    <thead>
                        <tr>
                            <th id="tablehead" style="width:40%"><?php echo __('Employee name'); ?></th>
                            <th id="tablehead" style="width:54%"><?php echo __('Timesheet Period'); ?></th>
                            <th style="width:6%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($sf_data->getRaw('pendingApprovelTimesheets') as $pendingApprovelTimesheet):
                            ?>
                            <tr class="<?php echo ($i & 1) ? 'even' : 'odd'; ?>">
                        <input type="hidden" name="timesheetId" value="<?php echo $pendingApprovelTimesheet['timesheetId']; ?>" />
                        <input type="hidden" name="employeeId" value="<?php echo $pendingApprovelTimesheet['employeeId']; ?>" />
                        <input type="hidden" name="startDate" value="<?php echo $pendingApprovelTimesheet['timesheetStartday']; ?>" />
                        <td>
                            <?php echo $pendingApprovelTimesheet['employeeFirstName'] . " " . $pendingApprovelTimesheet['employeeLastName']; ?>
                        </td>
                        <td>
                            <?php echo set_datepicker_date_format($pendingApprovelTimesheet['timesheetStartday']) . " " . __("to") . " " . set_datepicker_date_format($pendingApprovelTimesheet['timesheetEndDate']) ?>
                        </td>
                        <td align="center" class="<?php echo $pendingApprovelTimesheet['timesheetId'] . "##" . $pendingApprovelTimesheet['employeeId'] . "##" . $pendingApprovelTimesheet['timesheetStartday'] ?>">
                            <a href="<?php
                    echo 'viewPendingApprovelTimesheet?timesheetId=' .
                    $pendingApprovelTimesheet['timesheetId'] . '&employeeId=' .
                    $pendingApprovelTimesheet['employeeId'] . '&timesheetStartday=' .
                    $pendingApprovelTimesheet['timesheetStartday'];
                            ?>" id="viewSubmitted">
                                <?php echo __("View"); ?>
                            </a>
                        </td>
                        </tr>                        
                        <?php
                        $i++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
<?php endif; ?>
<?php }?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#departmentSelectForm").validate({
            rules: {
                'time[sub_unit]' : {
                    required:false,
                }
            }
        });
        $('#viewSubmitted').click(function() {
            var data = $(this).parent().attr("class").split("##");
            var url = 'viewPendingApprovelTimesheet?timesheetId='+data[0]+'&employeeId='+data[1]+'&timesheetStartday='+data[2];
            $(location).attr('href',url);
        });    
        $('#btnSearch').click(function() {
            $('#departmentSelectForm').submit();
        });
        $('#resetBtn').click(function() {
            var url = 'viewDepartmentTimesheet';
            $(location).attr('href',url);
        });
    });
    
</script>

