<script>
function showTab(tabId) {
    var tabContents = document.getElementsByClassName('tab-content');

    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].classList.remove('active');
    }

    var selectedTab = document.getElementById(tabId);

    if (selectedTab) {
        selectedTab.classList.add('active');
    }
}
</script>
<script src="code/highcharts.js"></script>
<script src="code/modules/exporting.js"></script>
<script src="code/modules/data.js"></script>
<script src="code/modules/export-data.js"></script>
<script src="code/modules/accessibility.js"></script>