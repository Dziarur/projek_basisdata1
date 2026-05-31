</div><!-- end page-content -->
</div><!-- end main-wrap -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('show');
}

function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('show');
}

// Confirm delete
function confirmDelete(url, name) {
    if(confirm('Hapus "' + name + '"?\nTindakan ini tidak dapat dibatalkan.')) {
        window.location.href = url;
    }
}
</script>
</body>
</html>
