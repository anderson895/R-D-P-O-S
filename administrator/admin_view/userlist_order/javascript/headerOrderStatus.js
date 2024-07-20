function showTab(tabId) {
    let tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(function(tabContent) {
        tabContent.classList.remove('active');
    });
    document.getElementById(tabId + '-content').classList.add('active');

    let tabs = document.querySelectorAll('.tab');
    tabs.forEach(function(tab) {
        tab.classList.remove('active');
    });

    let clickedTab = document.querySelector('.tab[onclick="showTab(\'' + tabId + '\')"]');
    clickedTab.classList.add('active');
}