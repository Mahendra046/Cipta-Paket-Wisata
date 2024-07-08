<aside class="control-sidebar control-sidebar-dark position-fixed" style="background-color: #00000071; border:0;">
    <!-- Control sidebar content goes here -->
    <div class="p-3" style="
        display:flex;
        flex-wrap:wrap;
        justify-content:space-between;
        gap:1rem;
    ">
        @foreach (auth()->user()->role as $role)
        <x-layout-app.module-box
            url="{{$role->module->url}}"
            color="{{$role->module->color}}"
            title="{{$role->module->title}}"
            subtitle="{{$role->module->subtitle}}" />
        @endforeach
    </div>
  </aside>