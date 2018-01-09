<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php /*$this->Site->script('masked-input/masked-input.min.js','plugin',['block'=>'topScripts'])*/ ?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Create New Fee </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($fee,['id'=>'add-new-fee']) ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <fieldset>
                                <?php
                                echo $this->Form->control('fee_category_id', ['options' => $feeCategories,'id'=>'fee_category_id']);
                                echo $this->Form->label('Amount');
                                echo $this->Form->control('amount',[
                                    'id' => 'amount',
                                    'type' => 'text',
                                    'templates' => [
                                        'label' => '',
                                        'inputContainer' => '<div class=" col-12-6 m-b-15 input-group {{type}}{{required}}"> <span class="input-group-addon"> &#8358;  </span>  {{content}} <span class="input-group-addon">.00</span></div>',
                                    ]
                                ]);
                                echo $this->Form->control('term_id', ['id'=>'term_id','options' => $terms, 'empty' =>'All']);
                                echo $this->Form->control('class_id', ['id' => 'class_id','options' => $classes,'empty'=>'Select Class','required'=>true]);
                                echo $this->Form->control('session_id', ['id'=>'session_id','options' => $sessions,'empty'=>'Select Session','required'=>true]);
                                echo $this->Form->control('compulsory',['id'=>'compulsory','data-render'=>'switchery','type'=>'checkbox','checked'=>true,'label'=>'Compulsory Fee for All Students(Please Turn this off if fee is for some specify students )']);
                                echo $this->Form->control('create_students_records',['id'=>'create_students_records','data-render'=>'switchery','type'=>'checkbox','checked'=>true,'label'=>'Create Fee record For Students under the selected Class']);
                                ?>
                            </fieldset>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo $this->Form->label('Expect Total Amount');
                            echo $this->Form->control('income_amount_expected',[
                                    'id'=>'expected-total-amount',
                                    'templates' => [
                                        'label' => '',
                                        'inputContainer' => '<div class=" col-12-6 m-b-15 input-group {{type}}{{required}}"> <span class="input-group-addon"> &#8358;  </span>  {{content}} <span class="input-group-addon">.00</span></div>',
                                    ]
                                ]);
                            echo $this->Form->control('number_of_students',['id' => 'number-of-students'])
                            ?>
                        </div>
                    </div>
                <?= $this->Form->button(__('Create New Fee'),[ 'id'=>'createNewFee-button', 'class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script>
    var handleAddNewFee  = function() {

        var classIdValue = $('#class_id');
        var amount = $('#amount');
        var expectedAmount = $('#expected-total-amount') ;
        var numberOfStudents = $('input#number-of-students') ;

        $('#class_id, #session_id').on('change', function() {

            if ((classIdValue.val() === '') || ($('#session_id').val() === '')) {
                $('#createNewFee-button').prop('disabled', true);
            } else {
                $('#createNewFee-button').prop('disabled', false);
            }
        });
        $('#class_id,#session_id').change();




        classIdValue.change(function(){
            if ( classIdValue.length !== 0 ) { //
                $.ajax({
                    type: "GET",
                    url:'<?= $this->Url->build(['controller'=>'Students','action'=>'get_students_count_by_class_id'], true) ?>' ,
                    contentType:false,
                    cache:false,
                    //processData:false,
                    data:{'class_id':classIdValue.val()},
                    success: function(data){
                        numberOfStudents.val(data);
                        // calculating expected amount
                         expectedAmount.val(amount.val() * data) ;
                    },
                    dataType: 'text'
                });
            } else {
                console.log('select a value');
            }
            // make ajax request
        });

        amount.change(function(){
           if ( numberOfStudents.val() !== 0 ) {
               expectedAmount.val(amount.val() * numberOfStudents.val())
           }
        });


        // todo : work on this later
        $('#add-new-f').submit(function(e){
            var thisForm = this;
            e.preventDefault();
            swal({
                    title: "Are you sure ",
                    text: "You are about to create fee with the following details ",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    closeOnCancel: false,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No"
                },function(isConfirm){
                    if (isConfirm) {
                        var result;

                        // make an ajax request.
                        $.ajax({
                            type: "POST",
                            url: window.location,
                            contentType:false,
                            cache:false,
                            processData:false,
                            data: new FormData(thisForm),
                            dataType: 'text',
                            success: function(data,status){
                                result = data;
                                if ( status === 200 ) {
                                    setTimeout(function(){
                                        swal(result);
                                    }, 2000);
                                }
                            },
                        });
                        /*setTimeout(function(){
                            swal(result);
                        }, 2000);*/

                    }else {
                        swal("Cancelled", "", "error");
                    }
                }
            );
        });

        /*$('#add-new-fee').on('submit',function(event){
            event.preventDefault();
            var result ;
            var thisForm = this ;

            // make an ajax request.
            $.ajax({
                type: "POST",
                url: window.location,
                contentType:false,
                cache:false,
                processData:false,
                data: thisForm.serialize()/*new FormData(thisForm),
                success: function(data,status){
                    result = data;
                },
                dataType: 'text'
            });
            setTimeout(function(){
                swal(result);
            }, 2000);

            swal({
                    title: "Are you sure ",
                    text: "This fee will be created this for every student in the specified class",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    closeOnCancel: false,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No"
                },
                function(isConfirm){
                    if (isConfirm ) {
                        // make an ajax request.
                        $.ajax({
                            type: "POST",
                            url: window.location,
                            contentType:false,
                            cache:false,
                            processData:false,
                            data:new FormData(thisForm) ,
                        success: function(data,status){
                            result = data;
                        },
                        dataType: 'text'
                        });
                        setTimeout(function(){
                            swal(result);
                        }, 2000);
                    } else {
                        swal("Cancelled", "", "error");
                    }

                });
        })*/
    };
    handleAddNewFee();
</script>