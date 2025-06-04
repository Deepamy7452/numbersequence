<?php
// config/numbersequence.php
/*
    |--------------------------------------------------------------------------
    | Number Sequence Mapping Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration array maps module or entity names (keys) to their
    | respective database column and Eloquent model class names.
    |
    | Each entry defines:
    |   - 'column': The database column name where the sequence number is stored.
    |   - 'model':  The model class name (without namespace) representing the entity.
    |
    | These mappings are used by NumberSeqHelper to generate and apply
    | sequence numbers consistently across different modules.
    |
    | Add or update entries here to manage number sequences for new modules.
    |
    */
return [
    'map' => [
        'Document Request'      => ['column' => 'dreq_code',        'model' => 'DocumentRequest'],
        'Attendance Checkin'    => ['column' => 'attSequence',      'model' => 'AttendanceSequence'],
        'Department'            => ['column' => 'dept_code',        'model' => 'Department'],
        'Asset Group'           => ['column' => 'code',             'model' => 'Assetgroup'],
        'Asset Master'          => ['column' => 'asset_id',         'model' => 'Assets'],
        'Recruitment'           => ['column' => 'mpr_ref_no',       'model' => 'Recruitment'],
        'Job'                   => ['column' => 'job_code',         'model' => 'Job'],
        'Position'              => ['column' => 'pos_code',         'model' => 'Position'],
        'User Master'           => ['column' => 'code',             'model' => 'User'],
        'Leave Request'         => ['column' => 'lr_ref_no',        'model' => 'LeaveRequest'],
        'WFH Request'           => ['column' => 'Wfh_refid',        'model' => 'WFHRequestModal'],
        'WFH Master'            => ['column' => 'sr_no',            'model' => 'WFHmodal'],
        'LCEG Request'          => ['column' => 'refid',            'model' => 'LateCEarlyGo'],
        'MNP Request'           => ['column' => 'mpr_ref_no',       'model' => 'MNP_request'],
        'MNP Requsition'        => ['column' => 'mpr_ref_no',       'model' => 'MNP_request'],
        'Course'                => ['column' => 'CourseId',         'model' => 'Course'],
        'CourseTask'            => ['column' => 'CourseTaskId',     'model' => 'CourseTask'],
        'EnrolledCourse'        => ['column' => 'AssignmentID',     'model' => 'CourseAssignment'],
        'SurveyAssigned'        => ['column' => 'assignmentID',     'model' => 'SurveyAssignment'],
        'TravelExpense Request' => ['column' => 'req_id',           'model' => 'TravelExpense'],
        'HalfDay Leave Request' => ['column' => 'lr_ref_no',        'model' => 'HalfdayLeave'],
        'Leave Encashment'      => ['column' => 'code',             'model' => 'LeaveEncashment'],
        'Overtime Request'      => ['column' => 'code',             'model' => 'OvertimeRequest'],
        'AdvanceLoanOrSalary'   => ['column' => 'code',             'model' => 'AdvanceSaleryLoan'],
        'Work Calendar'         => ['column' => 'wcal_code',        'model' => 'WorkCalenderModel'],
        'Employee'              => ['column' => 'emp_code',         'model' => 'Employee'],
        'Unpaid Leave'          => ['column' => 'code',             'model' => 'UnpaidLeave'],
    ],
];
