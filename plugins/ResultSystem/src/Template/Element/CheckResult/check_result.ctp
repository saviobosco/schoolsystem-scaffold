<style>
    .blur .result-checker-modal {
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        z-index: 9999;
        width: 100%;
        height: 100%;
        padding-top: 100px;
        background-color: black;
        background-color: rgba(0, 0, 0, 0.4);
        -webkit-transition: 0.5s;
        overflow: auto;
        transition: all 0.3s linear;
    }

</style>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4> Result Checker </h4>
    </div>
    <div class="panel-body">
        <div id="result-checker" class="result-checker">
            <div id="error-message"></div>
            <div class="result-checker-modal">
                <p id="result-checker-loading-status" style="color: white; display: none;" class="text-center"> <i class="fa fa-spinner fa-spin"></i> loading student information ...</p>
            </div>
            <div>
                <?= $this->Flash->render('result') ?>
                <?= $this->Form->create(null,[
                    'url'=>[
                        'plugin'=>'ResultSystem',
                        'controller'=>'CheckResult',
                        'action'=>'checkResult'
                    ],
                    'class' => 'form-horizontal',
                    'id' => 'result-checker-form'
                ]) ?>
                <fieldset>
                    <?php
                    echo $this->Form->input('admission_number',['id' => 'admission_number','class'=>'input-sm form-control','required'=>true,'label' => ['class'=> 'control-label col-sm-4', 'text'=>['Admission No.']]]);
                    ?>
                    <div>
                        <div class="row">
                            <div class="col-sm-offset-4 col-sm-8" id="student_details">
                            </div>
                        </div>
                    </div>

                    <?php
                    echo $this->Form->input('class_id', [ 'id' => 'result-checker-class', 'class' => 'form-control','required'=>true,'empty'=>true,'options' => null,'label'=>['class'=> 'control-label col-sm-4','text'=>'Class']]);
                    echo $this->Form->input('session_id', ['id' => 'result-checker-session', 'class' => 'form-control','required'=>true,'empty'=>true,'options' => null,'label'=>['class'=> 'control-label col-sm-4','text'=>'Session']]);
                    echo $this->Form->input('term_id', ['id' => 'result-checker-term', 'class' => 'form-control','required'=>true,'empty'=>true,'options' => null,'label' => ['class'=> 'control-label col-sm-4','text' => 'Term']]);
                    echo $this->Form->input('pin',['class'=>'form-control input-sm','required'=>true,'label' => ['class'=> 'control-label col-sm-4', 'text'=>['Pin']]]);

                    ?>
                </fieldset>
                <?= $this->Form->button(__('Check Result'),['class'=>'btn btn-primary btn-sm pull-right']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <p class="text-center"> Powered by <a href="<?= Cake\Core\Configure::read('Application.Href_link') ?>"><?= Cake\Core\Configure::read('Application.Company') ?> </a>  </p>
    </div>
</div>
<?= $this->Html->script('http.js') ?>
<script>
    var states = {
        student_id: "",
        session_id : "",
        class_id : "",
        term_id : "",
        pin : "",
        studentDetails :{},
        classes : [],
        sessions : [{}],
        terms : [{}]
    };

    var elements = {
        student_details : document.querySelector("#student_details"),
        error_message : document.querySelector("#error-message"),
        resultCheckerClassSelector : document.getElementById('result-checker-class'),
        resultCheckerSessionSelector : document.getElementById('result-checker-session'),
        resultCheckerTermSelector : document.getElementById('result-checker-term'),
        resultCheckerForm : document.getElementById('result-checker-form')
    };
    var CheckResultView = (function() {
        return {
            displayStudentDetails : function(studentDetail) {
                if (studentDetail) {
                    markup = '<div class="well"> <p> Full Name:  <span>' + studentDetail.first_name + ' ' + studentDetail.last_name + '</span> </p><p>Current Class: <span> '+ studentDetail.class.class + '</span> </p> </div> ';
                    elements.student_details.insertAdjacentHTML('beforeend', markup);
                }
            },
            showLoading: function() {
                var resultChecker = document.getElementById("result-checker");
                if (typeof(resultChecker) === "object") {
                    resultChecker.classList.add("blur");
                    var resultCheckerLoadingStatus = document.getElementById("result-checker-loading-status");
                    if (typeof(resultCheckerLoadingStatus) === "object") {
                        resultCheckerLoadingStatus.style.display = "block";
                    }
                }
            },
            clearLoading: function() {
                var resultChecker = document.getElementById("result-checker");
                if (typeof(resultChecker) === "object") {
                    resultChecker.classList.remove("blur");
                    var resultCheckerLoadingStatus = document.getElementById("result-checker-loading-status");
                    if (typeof(resultCheckerLoadingStatus) === "object") {
                        resultCheckerLoadingStatus.style.display = "none";
                    }
                }
            },
            clearDisplay: function() {
                elements.student_details.innerHTML = "";
            },
            clearErrorMessage: function() {
                elements.error_message.innerHTML = "";
            },
            displayErrorMessage: function(error) {
                var markup = '<p class="text-danger text-center">' + error + '</p>';
                elements.error_message.insertAdjacentHTML('beforeend', markup);
            }
        }
    })();

    var CheckResultController = (function() {
        return {
            handleStudentId: function() {
                // register the event handler
                document.querySelector("#admission_number").addEventListener("blur",function(event) {
                    var reg_number = event.target.value;
                    if (!reg_number) {
                        states.student_id = '';
                        CheckResultView.clearDisplay();
                        CheckResultView.clearErrorMessage();
                        // reset all states
                        states.classes = [];
                        states.sessions =[{}];
                        states.terms =[{}];
                        elements.resultCheckerClassSelector.options.length = 0;
                        elements.resultCheckerSessionSelector.options.length = 0;
                        elements.resultCheckerTermSelector.options.length = 0;
                        return;
                    }
                    states.student_id = reg_number;
                    var queryStringObject = { 'student_id' : states.student_id };
                    CheckResultView.showLoading();
                    app.client.request(undefined, '/result-system/check-result/get-student', 'GET', queryStringObject, undefined, function(statusCode, responsePayload){
                        if (statusCode !== 200) {
                            // Try to get the error from the api, or set a default error message
                            var error = typeof(responsePayload.Error) == 'string' ? responsePayload.Error : 'An error has occurred, please try again';

                            CheckResultView.clearLoading();
                            CheckResultView.clearErrorMessage();
                            CheckResultView.clearDisplay();
                            // Set the formError field with the error text
                            CheckResultView.displayErrorMessage(error);
                        } else {
                            CheckResultView.clearDisplay();
                            CheckResultView.clearErrorMessage();
                            CheckResultView.clearLoading();
                            states.studentDetails = responsePayload;
                            states.class_id = responsePayload.class_id;
                            CheckResultView.displayStudentDetails(responsePayload);
                            // set the classes
                            states.classes = [];
                            states.classes.push(responsePayload.class);
                            if (states.classes.length > 0) {
                                for (let i = 0; i < states.classes.length ; i++ ) {
                                    elements.resultCheckerClassSelector.options[i] = new Option(states.classes[i].class, states.classes[i].id, true, true);
                                }
                                // get the sessions
                                queryStringObject.class_id = states.studentDetails.class_id;
                                app.client.request(undefined,'/result-system/check-result/get-student-result-sessions', 'GET', queryStringObject, undefined, function(statusCode, responsePayload) {
                                   if (statusCode !== 200) {
                                       // Try to get the error from the api, or set a default error message
                                       var error = typeof(responsePayload.Error) == 'string' ? responsePayload.Error : 'An error has occurred, please try again';

                                       CheckResultView.clearLoading();
                                       // Set the formError field with the error text
                                       CheckResultView.displayErrorMessage(error);
                                   } else {
                                       states.sessions = [{}];
                                       CheckResultView.clearErrorMessage();
                                       (Array.from(responsePayload)).forEach(function(session) {
                                           states.sessions.push(session);
                                       });
                                       if (states.sessions.length > 0) {
                                           elements.resultCheckerSessionSelector.options[0] = new Option('Select Session', '', false, false);
                                           for (var i = 1; i < states.sessions.length ; i++ ) {
                                               elements.resultCheckerSessionSelector.options[i] = new Option(states.sessions[i].session,  states.sessions[i].id, false, false);
                                           }
                                       }
                                   }
                                });
                            }
                        }
                    });
                });

                elements.resultCheckerSessionSelector.addEventListener("change", function(event) {
                    states.session_id = ( typeof(event.target.value) === "string") ? event.target.value : false ;
                    if (states.student_id && states.class_id && states.session_id) {
                        // get the term
                        var queryStringObject = {
                            student_id : states.student_id,
                            class_id: states.class_id,
                            session_id : states.session_id
                        };
                        CheckResultView.showLoading();
                        app.client.request(undefined, '/result-system/check-result/get-student-result-terms', 'GET', queryStringObject, undefined, function(statusCode, responsePayload) {
                           if (statusCode !== 200) {
                               // Try to get the error from the api, or set a default error message
                               var error = typeof(responsePayload.Error) == 'string' ? responsePayload.Error : 'An error has occurred, please try again';

                               CheckResultView.clearLoading();
                               // Set the formError field with the error text
                               CheckResultView.displayErrorMessage(error);
                           } else {
                               states.terms = [{}]; // reset the terms state
                               CheckResultView.clearLoading();
                               CheckResultView.clearErrorMessage();
                               var terms = Array.from(responsePayload);
                               terms.forEach(function(value) {
                                   states.terms.push(value);
                               });
                               if (states.terms.length > 0) {
                                   elements.resultCheckerTermSelector.options[0] = new Option('Select Term', '', false, false);
                                   for (var i = 1; i < states.terms.length ; i++ ) {
                                       elements.resultCheckerTermSelector.options[i] = new Option(states.terms[i].name,  states.terms[i].id, false, false);
                                   }
                               }

                           }
                        });
                    }
                });

                /*elements.resultCheckerForm.addEventListener("submit", function(event) {
                    // prevent form from submitting
                    event.preventDefault();
                    // get all form inputs
                    var formId = this.id;
                    var path = this.action;
                    var method = this.method.toUpperCase();
                    // Turn the inputs into a payload
                    var payload = {};
                    var elements = this.elements;
                    for(var i = 0; i < elements.length; i++){
                        if(elements[i].type !== 'submit'){
                            // Determine class of element and set value accordingly
                            var classOfElement = typeof(elements[i].classList.value) == 'string' && elements[i].classList.value.length > 0 ? elements[i].classList.value : '';
                            var valueOfElement = elements[i].type == 'checkbox' && classOfElement.indexOf('multiselect') == -1 ? elements[i].checked : classOfElement.indexOf('intval') == -1 ? elements[i].value : parseInt(elements[i].value);
                            var elementIsChecked = elements[i].checked;
                            // Override the method of the form if the input's name is _method
                            var nameOfElement = elements[i].name;
                            if(nameOfElement == '_method'){
                                method = valueOfElement;
                            } else {
                                // Create an payload field named "method" if the elements name is actually httpmethod
                                if(nameOfElement == 'httpmethod'){
                                    nameOfElement = 'method';
                                }
                                // Create an payload field named "id" if the elements name is actually uid
                                if(nameOfElement == 'uid'){
                                    nameOfElement = 'id';
                                }
                                // If the element has the class "multiselect" add its value(s) as array elements
                                if(classOfElement.indexOf('multiselect') > -1){
                                    if(elementIsChecked){
                                        payload[nameOfElement] = typeof(payload[nameOfElement]) == 'object' && payload[nameOfElement] instanceof Array ? payload[nameOfElement] : [];
                                        payload[nameOfElement].push(valueOfElement);
                                    }
                                } else {
                                    payload[nameOfElement] = valueOfElement;
                                }

                            }
                        }
                    }
                    // Call the API
                    app.client.request(undefined,path,method,undefined,payload,function(statusCode,responsePayload){
                        // Display an error on the form if needed
                        if(statusCode !== 200){

                            if(statusCode == 403){
                                // log the user out
                                //app.logUserOut();

                            } else {
                                // Try to get the error from the api, or set a default error message
                                var error = typeof(responsePayload.Error) == 'string' ? responsePayload.Error : 'An error has occured, please try again';
                                CheckResultView.displayErrorMessage(error);
                            }
                        } else {
                            // If successful, send to form response processor
                            var proceed = confirm('Are you sure you want to proceed ?');
                        }

                    });
                });*/
            }
        }
    })();

    var CheckResultModel = (function() {
        return {
            fetchStudentDetails: function() {
                if(window.fetch && typeof window.fetch === "function") {
                    return fetch(window.location.href + '/students-manager/view/' + states.student_id, {
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
