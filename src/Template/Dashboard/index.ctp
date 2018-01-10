<div class="row">
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-green">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
            <div class="stats-title">STUDENTS</div>
            <div class="stats-number">
                <?= $this->cell('Dashboard::getNumberOfStudents'); ?>
            </div>
            <div class="stats-progress progress">
                <div class="progress-bar" style="width: 70.1%;"></div>
            </div>
            <div class="stats-desc">Better than last week (70.1%)</div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-blue">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-book fa-fw"></i></div>
            <div class="stats-title">SUBJECTS</div>
            <div class="stats-number">
                <?= $this->cell('Dashboard::getNumberOfSubjects'); ?>
            </div>
            <div class="stats-progress progress">
                <div class="progress-bar" style="width: 40.5%;"></div>
            </div>
            <div class="stats-desc">Better than last week (40.5%)</div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-purple">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-user fa-fw"></i></div>
            <div class="stats-title">ADMINS</div>
            <div class="stats-number">
                <?= $this->cell('Dashboard::getNumberOfAdmins'); ?>
            </div>
            <div class="stats-progress progress">
                <div class="progress-bar" style="width: 76.3%;"></div>
            </div>
            <div class="stats-desc">Better than last week (76.3%)</div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-black">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-calendar-o fa-fw"></i></div>
            <div class="stats-title">SESSIONS</div>
            <div class="stats-number">
                <?= $this->cell('Dashboard::getNumberOfSessions'); ?>
            </div>
            <div class="stats-progress progress">
                <div class="progress-bar" style="width: 54.9%;"></div>
            </div>
            <div class="stats-desc">Better than last week (54.9%)</div>
        </div>
    </div>
    <!-- end col-3 -->
</div>
<!-- end row -->