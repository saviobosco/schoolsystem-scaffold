<?= $this->Flash->render('result') ?>
<?= $this->Form->create(null,['url'=>['plugin'=>'ResultSystem', 'controller'=>'CheckResult', 'action'=>'checkResult'],'class' => 'form-horizontal']) ?>
    <fieldset>
        <?php
        echo $this->Form->input('reg_number',['id' => 'reg_number','class'=>'input-sm form-control','required'=>true,'label' => ['class'=> 'control-label col-sm-4', 'text'=>['Admission No.']]]);
        ?>
        <div>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-8" id="student_details">
                </div>
            </div>
        </div>
        
        <?php
        echo $this->Form->input('pin',['class'=>'form-control input-sm','required'=>true,'label' => ['class'=> 'control-label col-sm-4', 'text'=>['Pin']]]);
        echo $this->Form->input('class_id', ['class' => 'form-control','required'=>true,'empty'=>true,'options' => $classes,'label'=>['class'=> 'control-label col-sm-4','text'=>'Select Class']]);
        echo $this->Form->input('session_id', ['class' => 'form-control','required'=>true,'empty'=>true,'options' => $sessions,'label'=>['class'=> 'control-label col-sm-4','text'=>'Session']]);
        echo $this->Form->input('term_id', ['class' => 'form-control','required'=>true,'empty'=>true,'options' => $terms,'label' => ['class'=> 'control-label col-sm-4','text' => 'Term']]);
        ?>
    </fieldset>
<?= $this->Form->button(__('Check Result'),['class'=>'btn btn-primary btn-sm']) ?>
<?= $this->Form->end() ?>
<script>
    var states = {
        student_id: ""
    };
    var elements = {
        student_details : document.querySelector("#student_details"),
    }
    var CheckResultView = (function() {
        return {
            displayStudentDetails : function(studentDetail) {
                if (studentDetail) {
                    markup = '<div class="well"> <p> Full Name:  <span>' + studentDetail.first_name + ' ' + studentDetail.last_name + '</span> </p><p>Current Class: <span> '+ studentDetail.class.class + '</span> </p> </div> ';
                    elements.student_details.insertAdjacentHTML('beforeend', markup);
                }
            },
            showLoading: function() {
                markup = '<p class="text-center"> <i class="fa fa-spinner fa-spin"></i> loading student information ...</p>'
                elements.student_details.insertAdjacentHTML('beforeend', markup)
            },
            clearDisplay: function() {
                elements.student_details.innerHTML = "";
            },
            displayErrorMessage: function(error) {
                markup = '<p class="text-danger text-center">' + error + '</p>';
                elements.student_details.insertAdjacentHTML('beforeend', markup);
            }
        }
    })();

    var CheckResultController = (function() {
        return {
            handleStudentId: function() {
                // register the event handler
                document.querySelector("#reg_number").addEventListener("blur",function(event) {
                    var reg_number = event.target.value;
                    if (!reg_number) {
                        states.student_id = '';
                        return;
                    }
                    states.student_id = reg_number;
                    CheckResultView.clearDisplay();
                    CheckResultView.showLoading();
                    CheckResultModel.fetchStudentDetails()
                    .then(function(data) {
                        CheckResultView.clearDisplay();
                        CheckResultView.displayStudentDetails(data);
                    }).catch(function(error) {
                        CheckResultView.clearDisplay();
                        CheckResultView.displayErrorMessage(error);
                    });
                });
            }
        }
    })();

    var CheckResultModel = (function() {
        return {
            fetchStudentDetails: function() {
                if(window.fetch && typeof window.fetch === "function") {
                    return fetch(window.location.origin + '/students-manager/view/' + states.student_id, {
                        method: "get",
                        headers: {"Accept": "application/json"}
                    }).then(function(response) {
                        if (response.status >= 200 && response.status < 300) {
                            return Promise.resolve(response.json());
                        } else {
                            return Promise.reject(response.statusText);
                        }
                    })
                } else {
                    return Promise.reject('Your browser is too low. Please update it');
                }
            },
            getStudentDetails: function() {
                if (states.student_details) {
                    return states.student_details;
                }
                return {};
            }
        }
    })();
    window.onload = function() {
        CheckResultController.handleStudentId();
    }
</script>
