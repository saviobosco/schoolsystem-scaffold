<?php /* $this->Site->css('bootstrap-daterangepicker/daterangepicker.css', 'plugin', ['block' => 'topCss'])*/ ?>
<?php
$formTemplates = [
    'radioWrapper' => '{{label}}',
];
$this->Form->templates($formTemplates);

?>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Expenditure  Statistics </h4>
                </div>
                <div class="panel-body">
                    <?= $this->Form->create(null, ['id'=>'get-expenditure-form', 'class' => 'form-horizontal form-bordered m-b-20']) ?>
                    <div class="form-group text-center">
                        <label class="m-r-15" for="query-week">
                            <input name="query" value="week" type="radio"> This Week
                        </label>
                        <label class="m-r-15" for="query-week">
                            <input name="query" value="month" type="radio"> This Month
                        </label>
                        <label class="m-r-15" for="query-week">
                            <input name="query" value="year" type="radio"> This Year
                        </label>
                        <label class="m-r-15" for="query-week">
                            <input name="query" id="custom" value="custom" type="radio"> Custom ( Select Date Range )
                        </label>
                    </div>

                    <div class="row" id="income-date-range">
                        <div class="col-sm-6">
                            <?= $this->Site->datePickerInput('start_date',['disabled'=>true]); ?>

                        </div>
                        <div class="col-sm-6">
                            <?= $this->Site->datePickerInput('end_date',['disabled'=>true]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('arrange_by_expenditure_categories',['type'=>'checkbox']) ?>
                    </div>
                    <?= $this->Form->submit(__('Get Expenditures'), ['class' => ' m-t-10 btn btn-primary pull-right']) ?>
                    <?= $this->Form->end() ?>

                    <div id="ajax-response">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("input[name=query]:radio").change(function () {
                var radioValue = $(this).val();
                if ( radioValue === 'custom') {
                    // get the date-range input
                    $('#income-date-range input').each(function(index){
                        // for each of them enable the input
                        $(this).prop('disabled',false);
                    })
                } else {
                    $('#income-date-range input').each(function(index){
                        // for each of them enable the input
                        $(this).prop('disabled',true);
                    })
                }
            })

            $('#get-expenditure-form').submit(function(event){
                event.preventDefault();
                // process an ajax request
                var thisValue = this;
                $.ajax({
                    type: "POST",
                    url:'<?= $this->Url->build(['action'=>'ajaxGetExpenditureStatistics'], true) ?>' ,
                    contentType:false,
                    cache:false,
                    processData:false,
                    data: new FormData(thisValue),
                    beforeSend:function(){
                        $('#ajax-response').html('<h2 class="text-center text-info"> <i class="fa fa-spinner fa-spin fa-fw"> </i> loading Data... </h2>');
                    },
                    success: function(data){
                        $('#ajax-response').html(data);
                    },
                    dataType: 'text'
                });
            });

            $( document ).ajaxComplete(function( event, request, settings ) {
                if ( request.status !== 200)
                    $('#ajax-response').html('<h2 class="text-center text-error"> <i class="fa fa-warning"> </i> An Error Occurred while performing the operation </h2>');
            });
        });
    </script>