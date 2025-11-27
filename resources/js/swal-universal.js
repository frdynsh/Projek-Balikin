// public/js/swal-universal.js
import Swal from "sweetalert2";

// Cek dark mode sistem
function isDarkMode() {
    return (
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches
    );
}

// Fungsi universal
export function confirmAction({ name, formId, actionType, url }) {
    const dark = isDarkMode();
    let title, icon, confirmButtonText, confirmButtonColor;

    switch (actionType) {
        case "hapus":
            title = "Hapus Permanen?";
            icon = "warning";
            confirmButtonText = "Ya, Hapus";
            confirmButtonColor = "#dc2626"; // merah
            break;
        case "setujui":
            title = "Setujui Laporan?";
            icon = "question";
            confirmButtonText = "Ya, Setujui";
            confirmButtonColor = "#16a34a"; // hijau
            break;
        case "tolak":
            title = "Tolak Laporan?";
            icon = "question";
            confirmButtonText = "Ya, Tolak";
            confirmButtonColor = "#dc2626"; // merah
            break;
        case "selesai": 
            title = "Tandai sebagai Selesai?";
            icon = "question";
            confirmButtonText = "Ya, Selesai";
            confirmButtonColor = "#3b82f6"; // biru
            break;
        default:
            return;
    }

    Swal.fire({
        title: `<span style="color:${confirmButtonColor}">${title}</span>`,
        html: (() => {
            switch (actionType) {
                case "hapus":
                    return `Anda yakin ingin menghapus <strong style="color:${confirmButtonColor}">${name}</strong>?<br><span>Aksi ini tidak dapat dibatalkan</span>`;
                case "setujui":
                    return `Anda yakin ingin menyetujui <strong style="color:${confirmButtonColor}">${name}</strong>?`;
                case "tolak":
                    return `Anda yakin ingin menolak <strong style="color:${confirmButtonColor}">${name}</strong>?`;
                case "selesai":
                    return `Anda yakin ingin menandai <strong style="color:${confirmButtonColor}">${name}</strong> sebagai selesai?`;
                default:
                    return name;
            }
        })(),
        icon,
        showCancelButton: true,
        confirmButtonText,
        cancelButtonText: "Batal",
        confirmButtonColor,
        cancelButtonColor: "#6b7280",
        background: dark ? "#1f2937" : "#ffffff",
        color: dark ? "#e5e7eb" : "#111827",
        customClass: {
            popup: dark ? "border border-gray-700" : "border border-gray-200",
        },
        didOpen: () => {
            document.body.style.paddingRight = "0px";
        },
        willClose: () => {
            document.body.style.paddingRight = "0px";
        },
    }).then((result) => {
        if (result.isConfirmed) {
            if (actionType === "edit" && url) {
                window.location.href = url;
            } else {
                const form = document.getElementById(formId);
                if (form) form.submit();
            }
        }
    });
}

// Inisialisasi tombol
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-action]").forEach((button) => {
        button.addEventListener("click", () => {
            confirmAction({
                name: button.dataset.name,
                formId: button.dataset.form,
                actionType: button.dataset.action,
                url: button.dataset.url, 
            });
        });
    });
});
