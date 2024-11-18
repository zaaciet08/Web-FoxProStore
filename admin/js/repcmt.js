

// Hàm để chuyển đổi giữa các tab
function changeTab(tabNumber) {
// Ẩn tất cả nội dung tab
var tabContents = document.querySelectorAll('.tab-content');
tabContents.forEach(function (tabContent) {
    tabContent.classList.remove('active');
});

// Hiển thị nội dung của tab được chọn
var selectedTab = document.getElementById('tab' + tabNumber);
selectedTab.classList.add('active');
}

// Đặt lớp active cho tab thứ nhất khi trang được load lại
document.addEventListener('DOMContentLoaded', function () {
changeTab(1);
});
