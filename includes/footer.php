<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
        $('#toggleSidebar').on('click', function() {
            $('#sidebar').toggleClass('show');
            $('#sidebar').toggleClass('collapsed');
            $(this).toggleClass('toggle');
            $('#content').toggleClass('full-width');
        });
        $(window).resize(function() {
            if (window.innerWidth > 768) {
                $('#sidebar').removeClass('show');
                $('#sidebar').removeClass('collapsed');
                $('#content').removeClass('full-width');
                $('#toggleSidebar').removeClass('toggle');
            }
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdownToggle = document.getElementById('barangToggle');
    const toggleIcon = document.getElementById('toggleIcon');
    const dropdown = document.getElementById('dropdownBarang');
    dropdownToggle.addEventListener('click', function () {
        const isOpen = dropdown.classList.contains('show'); 
        if (isOpen) {
            dropdown.classList.remove('show');
            toggleIcon.classList.remove('fa-chevron-up');
            toggleIcon.classList.add('fa-chevron-down');
        } else {
            dropdown.classList.add('show');
            toggleIcon.classList.remove('fa-chevron-down');
            toggleIcon.classList.add('fa-chevron-up');
        }
    });

    document.addEventListener('click', function (e) {
        if (!dropdownToggle.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.remove('show');
            toggleIcon.classList.remove('fa-chevron-up');
            toggleIcon.classList.add('fa-chevron-down');
        }
    });
});
    </script>
</body>
</html>
