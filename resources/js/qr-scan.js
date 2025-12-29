import { Html5Qrcode } from "html5-qrcode";

window.startQrScanner = async function (elementId, onSuccess) {
  const html5QrCode = new Html5Qrcode(elementId);

  const config = {
    fps: 10,
    qrbox: { width: 250, height: 250 },
    rememberLastUsedCamera: true,
  };

  try {
    const cameras = await Html5Qrcode.getCameras();
    if (!cameras || cameras.length === 0) {
      throw new Error("Kamera tidak ditemukan");
    }

    const cameraId = cameras[0].id;

    await html5QrCode.start(
      cameraId,
      config,
      (decodedText) => {
        try {
          // 🔑 ambil jadwal_id dari URL QR
          const url = new URL(decodedText);
          const jadwalId = url.searchParams.get("jadwal_id");

          if (!jadwalId) {
            throw new Error("QR tidak valid");
          }

          // kirim angka jadwal_id saja
          onSuccess(jadwalId);

          html5QrCode.stop().catch(() => {});
        } catch (err) {
          const el = document.getElementById("scan-error");
          if (el) el.textContent = "QR tidak valid";
        }
      },
      () => {}
    );
  } catch (e) {
    console.error(e);
    const el = document.getElementById("scan-error");
    if (el) el.textContent = "Gagal membuka kamera. Cek izin kamera.";
  }
};
