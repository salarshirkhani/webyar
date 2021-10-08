<x-sidebar-item title="پروفایل" icon="fas fa-tachometer-alt" route="dashboard.employee.profile" />
<x-sidebar-item title="مدیریت مسئولیت ها" icon="fas fa-folder" route="dashboard.employee.task.manage" />
<x-sidebar-item title="مدیریت مالی" icon="fas fa-money-check-alt" route="dashboard.employee.money.index" />
<x-sidebar-item title="پیام ها" icon="fas fa-envelope-open-text" route="dashboard.employee.message.manage"/>
<x-sidebar-item title="ویرایش مشخصات" icon="fas fa-user" route="dashboard.profile.edit" />
<x-sidebar-item :title="'امتیاز شما: ' . Auth::user()->score" icon="fas fa-medal" />
