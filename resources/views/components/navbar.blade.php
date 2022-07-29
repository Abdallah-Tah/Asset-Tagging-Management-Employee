<nav aria-label="secondary" x-data="{ open: false }"
    class="sticky top-0 z-10 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white dark:bg-dark-eval-1"
    :class="{
        '-translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }">

<div id="reportrange" class="pull-right"
style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #9a16b2; width: 36%">
<i class="glyphicon glyphicon-calendar fa fa-calendar "></i>&nbsp;
<span></span> <b class="caret"></b>
</div>

    <div class="flex items-center gap-3">
        <x-button type="button" class="md:hidden" iconOnly variant="secondary" srText="Toggle dark mode"
            @click="toggleTheme">
            <x-heroicon-o-moon x-show="!isDarkMode" aria-hidden="true" class="w-6 h-6" />
            <x-heroicon-o-sun x-show="isDarkMode" aria-hidden="true" class="w-6 h-6" />
        </x-button>
    </div>
    

    <div class="flex items-center gap-3">
       {{--  <x-button type="button" class="hidden md:inline-flex" iconOnly variant="secondary" srText="Toggle dark mode"
            @click="toggleTheme">
            <x-heroicon-o-moon x-show="!isDarkMode" aria-hidden="true" class="w-6 h-6" />
            <x-heroicon-o-sun x-show="isDarkMode" aria-hidden="true" class="w-6 h-6" />
        </x-button> --}}
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="flex items-center p-2 text-sm font-medium text-gray-500 rounded-md transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-purple-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                    <div>{{ Auth::user()->name }}</div>

                    <div class="ml-1">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>

<!-- Mobile bottom bar -->
<div class="fixed inset-x-0 bottom-0 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white md:hidden dark:bg-dark-eval-1"
    :class="{
        'translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }">
    <x-button type="button" iconOnly variant="secondary" srText="Search">
        <x-heroicon-o-search aria-hidden="true" class="w-6 h-6" />
    </x-button>

    <a href="{{ route('dashboard') }}">
        <x-application-logo aria-hidden="true" class="w-10 h-10" />
        <span class="sr-only">Asset Tagging Management</span></span>
    </a>

    <x-button type="button" iconOnly variant="secondary" srText="Open main menu"
        @click="isSidebarOpen = !isSidebarOpen">
        <x-heroicon-o-menu x-show="!isSidebarOpen" aria-hidden="true" class="w-6 h-6" />
        <x-heroicon-o-x x-show="isSidebarOpen" aria-hidden="true" class="w-6 h-6" />
    </x-button>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script type="text/javascript">
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        if (search = getParam('date_filter')) {
            var dateRanges = search.split(' - ');
            start = moment(new Date(dateRanges[0].trim() + ' 00:00:00'));
            end = moment(new Date(dateRanges[1].trim() + ' 11:59:59'));
        }

        function getParam(param) {
            return new URLSearchParams(window.location.search).get(param);
        }

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({

            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year')
                    .endOf('year')
                ],
                'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
            },

        }, cb).on('apply.daterangepicker', function(event, picker) {
            var date_filter = picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                'YYYY-MM-DD');
            window.location.href = window.location.origin + window.location.pathname + '?date_filter=' +
                date_filter;
        })

        cb(start, end);

    });
</script>