document.addEventListener("DOMContentLoaded", function() {
    // モーダルを開く関数
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "block";
        }
    }

    // モーダルを閉じる関数
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "none";
        }
    }

    // h3 タグをクリックしたときにモーダルを開く
    const modalTriggers = document.querySelectorAll("[data-modal]");

    modalTriggers.forEach(function(trigger) {
        trigger.addEventListener("click", function() {
            const modalId = trigger.dataset.modal; // datasetで属性値を取得
            openModal(modalId);
        });
    });

    // モーダルの閉じるボタンがクリックされたとき
    const closeButtons = document.querySelectorAll(".close");

    closeButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            const modalId = button.dataset.modal;
            closeModal(modalId);
        });
    });

    // モーダルの外側をクリックしたときにモーダルを閉じる
    window.addEventListener("click", function(event) {
        const openModals = document.querySelectorAll(".modal");

        openModals.forEach(function(modal) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
});
