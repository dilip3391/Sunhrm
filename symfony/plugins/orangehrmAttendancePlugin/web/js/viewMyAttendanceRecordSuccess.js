/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function()
{
    var rMonth = trim($("#month").val());
    var rYear = trim($("#year").val());
    if (rMonth == '') {
        $("#month").val();
    }

    else if (rYear == '') {
        $("#year").val();
    }
    
    if(trigger){
        $("#recordsTable").hide();
     
        // getRelatedAttendanceRecords(employeeId,monthSelected,yearSelected,actionRecorder);
    
        // $('#month').change(function() {
            // var isValidMonth= validateInputMonth();
                
            // if(isValidMonth){
                   
                var month=$("#month").val();
                var year=$("#year").val();
                // // var parsedDate = $.datepicker.parseDate(datepickerDateFormat, month);
                getRelatedAttendanceRecords(employeeId,month,year,actionRecorder);
            // }  

        // });
    }
    
    else{
        
        $("#recordsTable").hide();
     
        var rMonth = trim($("#month").val());
        var rYear = trim($("#year").val());
        if (rMonth == '' && rYear == '') {
            $("#month").val();
            $("#year").val();
        }

        // $('#month').change(function() {
    
            // var isValidDate= validateInputDate();
                
            // if(isValidDate){
                   
                var month=$("#month").val();
                var year=$("#year").val();
                // var parsedDate = $.datepicker.parseDate(datepickerDateFormat, date);
                getRelatedAttendanceRecords(employeeId,month,year,actionRecorder);
                    
            // }  

        // });       
        
    }
    
});
function validateInputDate(){
  
    errFlag = false;
    $(".messageBalloon_success").remove();
    $('#validationMsg').removeAttr('class');
    $('#validationMsg').html("");
    $("#attendance_date").removeAttr('style');

    var errorStyle = "background-color:#FFDFDF;";
        
    var date=$("#attendance_date").val();
    
        
    if(!validateDate(date, datepickerDateFormat)){
        $('#validationMsg').attr('class', "message warning");
        $('#validationMsg').html(errorForInvalidFormat);
        $("#attendance_date").attr('style', errorStyle);
        errFlag = true;
    }   
    return !errFlag ;
    
}

function getRelatedAttendanceRecords(employeeId,month,year,actionRecorder){
        
    $.post(
        linkForGetRecords,
        {
            employeeId: employeeId,
            month: month,
            year: year,
            actionRecorder:actionRecorder
        },
        
        function(data, textStatus) {
                      
            if( data != ''){
                $("#recordsTable").show();
                $('#recordsTable1').html(data);    
            }
                    
        });
                    
    return false;
        
}

String.prototype.isValidDate = function() {
    var IsoDateRe = new RegExp("^([0-9]{4})-([0-9]{2})-([0-9]{2})$");
    var matches = IsoDateRe.exec(this);
    if (!matches) return false;
  

    var composedDate = new Date(matches[1], (matches[2] - 1), matches[3]);

    return ((composedDate.getMonth() == (matches[2] - 1)) &&
        (composedDate.getDate() == matches[3]) &&
        (composedDate.getFullYear() == matches[1]));

}