CREATE VIEW total_jumlah AS
SELECT 'total_pinjaman' as table_name , SUM(Jumlah_Pinjaman) as total_value FROM pinjaman WHERE Status_Deleted = 0 AND Status = 'Disetujui'

UNION ALL

SELECT 'total_simpanan' as table_name , SUM(Jumlah_Simpanan) as total_simpanan FROM simpanan WHERE Status_Deleted = 0

UNION ALL

SELECT 'total_anggota'as table_name , COUNT(*) as total_members FROM anggota WHERE Status_Deleted = 0
