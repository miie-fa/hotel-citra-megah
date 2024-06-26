    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.select.min.js') }}"></script>
    <script src="{{asset('/js/core/jquery.min.js')}}"></script>
    <script src="{{asset('/js/plugins/jquery.dataTables.min.js')}}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>
    <script src="{{ asset('dist-front/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/iziToast.min.js') }}"></script>
    {{-- FilePond JS --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
        <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/6.6.0/fuse.min.js"></script>
    <script>
        const navbarSearchInput = document.getElementById('navbar-search-input');
        const searchResults = document.getElementById('search-results');
        const pageItems = Array.from(document.getElementsByClassName('nav-item'));

        const pageNames = pageItems.map(item => item.textContent);

        const options = {
            keys: ['name']
        };

        const fuse = new Fuse(pageNames, options);

        navbarSearchInput.addEventListener('input', function () {
            const results = fuse.search(this.value);

            searchResults.innerHTML = '';

            results.forEach(result => {
                const li = document.createElement('a');
                li.classList.add('dropdown-item');
                li.textContent = result.item;

                // Set tautan href berdasarkan hasil pencarian
                const cleanItem = result.item.toLowerCase().replace(/\s+/g, '');
                const itemWithoutS = cleanItem.endsWith('s') ? cleanItem.slice(0, -1) : cleanItem;

                li.href = itemWithoutS;

                searchResults.appendChild(li);
            });

            searchResults.style.display = 'block';
        });

        searchResults.addEventListener('click', function(event) {
            const clickedItem = event.target;

            if (clickedItem.classList.contains('dropdown-item')) {
                navbarSearchInput.value = clickedItem.textContent;
                searchResults.style.display = 'none';
            }
        });

        // Event listener untuk mereset pencarian dengan Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                resetSearch();
            }
        });

        // Event Ctrl+K untuk fokus ke input pencarian
        document.addEventListener('keydown', function (event) {
            if ((event.ctrlKey || event.metaKey) && event.key === 'k') {
                navbarSearchInput.focus();
                event.preventDefault();
            }
        });

        // Fungsi untuk mereset pencarian
        function resetSearch() {
            navbarSearchInput.value = '';
            searchResults.innerHTML = '';
            searchResults.style.display = 'none';
        }
    </script>



