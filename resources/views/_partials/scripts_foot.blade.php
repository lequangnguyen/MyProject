<!-- Core JS files -->
<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/nicescroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/drilldown.js') }}"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
@stack('js_files_foot')

<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js') }}"></script>

@stack('scripts_foot')
<!-- /theme JS files -->
