  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        VERSION : {{env('VERSION')}}
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ now()->year }}-{{ now()->year-1 }} <a href="https://adminlte.io">{{ env('APP_NAME') }}</a>.</strong> All rights reserved.
  </footer>
