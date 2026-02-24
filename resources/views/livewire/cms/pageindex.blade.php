<div style="padding:20px; background:#f6f6f6; min-height:100vh;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div>
            <h2 style="margin:0; font-size:22px; font-weight:bold; color:#111;">
                Dashboard CMS
            </h2>
            <p style="margin:4px 0 0 0; font-size:13px; color:#666;">
                Ringkasan data dan aktivitas sistem
            </p>
        </div>

        <div style="display:flex; gap:8px;">
            <input type="text" placeholder="Cari..."
                style="padding:10px; width:260px; border:1px solid #ccc; outline:none; background:white;">
            <button
                style="padding:10px 14px; border:1px solid #111; background:#111; color:white; cursor:pointer;">
                Search
            </button>
        </div>
    </div>

    <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:12px; margin-bottom:20px;">
        <div style="border:1px solid #ddd; background:white; padding:15px;">
            <div style="font-size:12px; color:#777;">Total PLTU</div>
            <div style="font-size:26px; font-weight:bold; margin-top:6px;">32</div>
        </div>

        <div style="border:1px solid #ddd; background:white; padding:15px;">
            <div style="font-size:12px; color:#777;">Total Provinsi</div>
            <div style="font-size:26px; font-weight:bold; margin-top:6px;">38</div>
        </div>

        <div style="border:1px solid #ddd; background:white; padding:15px;">
            <div style="font-size:12px; color:#777;">Total Kota/Kab</div>
            <div style="font-size:26px; font-weight:bold; margin-top:6px;">514</div>
        </div>

        <div style="border:1px solid #ddd; background:white; padding:15px;">
            <div style="font-size:12px; color:#777;">Total Desa</div>
            <div style="font-size:26px; font-weight:bold; margin-top:6px;">83.000</div>
        </div>
    </div>

    <div style="display:grid; grid-template-columns:2fr 1fr; gap:12px; margin-bottom:20px;">

        <div style="border:1px solid #ddd; background:white; padding:15px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                <h3 style="margin:0; font-size:16px; font-weight:bold;">Statistik Data</h3>
                <select style="padding:8px; border:1px solid #ccc; background:white;">
                    <option value="7">7 Hari</option>
                    <option value="30">30 Hari</option>
                    <option value="365">1 Tahun</option>
                </select>
            </div>

            <div style="height:240px; border:1px dashed #aaa; display:flex; align-items:center; justify-content:center;">
                <span style="font-size:13px; color:#777;">Chart Placeholder</span>
            </div>
        </div>

        <div style="border:1px solid #ddd; background:white; padding:15px;">
            <h3 style="margin:0 0 12px 0; font-size:16px; font-weight:bold;">Info Sistem</h3>

            <table style="width:100%; border-collapse:collapse; font-size:13px;">
                <tr>
                    <td style="padding:8px 0; color:#666;">Versi CMS</td>
                    <td style="padding:8px 0; font-weight:bold;">1.0</td>
                </tr>
                <tr>
                    <td style="padding:8px 0; color:#666;">Framework</td>
                    <td style="padding:8px 0; font-weight:bold;">Laravel + Livewire</td>
                </tr>
                <tr>
                    <td style="padding:8px 0; color:#666;">Database</td>
                    <td style="padding:8px 0; font-weight:bold;">MySQL / PostgreSQL</td>
                </tr>
                <tr>
                    <td style="padding:8px 0; color:#666;">Status</td>
                    <td style="padding:8px 0; font-weight:bold; color:green;">Online</td>
                </tr>
            </table>
        </div>

    </div>

    <div style="border:1px solid #ddd; background:white; padding:15px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
            <h3 style="margin:0; font-size:16px; font-weight:bold;">Data Terbaru</h3>
            <button style="padding:10px 14px; border:1px solid #111; background:white; cursor:pointer;">
                + Tambah Data
            </button>
        </div>

        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="background:#f3f3f3;">
                    <th style="border:1px solid #ddd; padding:10px; text-align:left;">ID</th>
                    <th style="border:1px solid #ddd; padding:10px; text-align:left;">Nama</th>
                    <th style="border:1px solid #ddd; padding:10px; text-align:left;">Kategori</th>
                    <th style="border:1px solid #ddd; padding:10px; text-align:left;">Tanggal</th>
                    <th style="border:1px solid #ddd; padding:10px; text-align:left;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td style="border:1px solid #ddd; padding:10px;">1</td>
                    <td style="border:1px solid #ddd; padding:10px;">PLTU Suralaya</td>
                    <td style="border:1px solid #ddd; padding:10px;">PLTU</td>
                    <td style="border:1px solid #ddd; padding:10px;">2026-02-14</td>
                    <td style="border:1px solid #ddd; padding:10px;">
                        <button style="padding:6px 10px; border:1px solid #111; background:white; cursor:pointer;">
                            Detail
                        </button>
                        <button style="padding:6px 10px; border:1px solid red; background:white; cursor:pointer; color:red;">
                            Hapus
                        </button>
                    </td>
                </tr>

                <tr>
                    <td style="border:1px solid #ddd; padding:10px;">2</td>
                    <td style="border:1px solid #ddd; padding:10px;">PLTU Paiton</td>
                    <td style="border:1px solid #ddd; padding:10px;">PLTU</td>
                    <td style="border:1px solid #ddd; padding:10px;">2026-02-13</td>
                    <td style="border:1px solid #ddd; padding:10px;">
                        <button style="padding:6px 10px; border:1px solid #111; background:white; cursor:pointer;">
                            Detail
                        </button>
                        <button style="padding:6px 10px; border:1px solid red; background:white; cursor:pointer; color:red;">
                            Hapus
                        </button>
                    </td>
                </tr>

                <tr>
                    <td style="border:1px solid #ddd; padding:10px;">3</td>
                    <td style="border:1px solid #ddd; padding:10px;">PLTU Tanjung Jati</td>
                    <td style="border:1px solid #ddd; padding:10px;">PLTU</td>
                    <td style="border:1px solid #ddd; padding:10px;">2026-02-12</td>
                    <td style="border:1px solid #ddd; padding:10px;">
                        <button style="padding:6px 10px; border:1px solid #111; background:white; cursor:pointer;">
                            Detail
                        </button>
                        <button style="padding:6px 10px; border:1px solid red; background:white; cursor:pointer; color:red;">
                            Hapus
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
