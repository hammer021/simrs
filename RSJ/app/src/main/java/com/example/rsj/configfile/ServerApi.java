package com.example.rsj.configfile;

public class ServerApi {
 //     public static final String IPServer="http://macarinaid.wsjti.com/RestApi/";
      public static final String IPServer="http://192.168.100.35/simrs/Web/api/";
      public static final String IPServerFoto="http://192.168.100.35/simrs/Web/assets/images/";
//      public static final String IPServer="http://192.168.43.254/simrs/Web/api/";
    public static final String URL_REGIS=IPServer+"Registerakun";
    public static final String URL_LOGIN=IPServer+"Api_login";
    public static final String URL_USER=IPServer+"Profil?kd_regist=";
    public static final String URL_PUT_USER=IPServer+"Profil";
    public static final String URL_PUT_PASSWORD=IPServer+"Profil/password";
    public static final String URL_PERIKSA=IPServer+"Konsul/periksa";
    public static final String URL_PERIKSALAGI=IPServer+"Konsul/riwayatPasien";
    public static final String URL_GETPERIKSA=IPServer+"Konsul?kd_regist=";
    public static final String URL_GETINBOX=IPServer+"Api_chat?kd_regist=";
    public static final String URL_GETPASIEN=IPServer+"Konsul/pasienselesai?kd_regist=";
    public static final String URL_GETDOKTER=IPServer+"Api_dokter/dokter";
    public static final String URL_BUKTI=IPServer+"Konsul/bukti";
    public static final String URL_RESEP=IPServer+"Konsul/selesai";
    public static final String URL_GETRESEP=IPServer+"Konsul/selesai?kd_regist=";
    public static final String URL_TAMPILCHAT=IPServer+"Api_chat";
    public static final String URL_TAMPILRIWAYAT=IPServer+"Konsul/riwayat?kd_regist=";
    public static final String URL_DASHBOARD=IPServer+"konsul/dashboard?kd_regist=";
    public static final String URL_PASFOTO=IPServerFoto+"user/";
    public static final String URL_FOTOPASIEN=IPServerFoto+"pasien/";
    public static final String URL_FOTODOKTER=IPServerFoto+"dokter/";
    public static final String URL_FOTORIWAYAT=IPServerFoto + "bukti_konsul/";
    public static final String URL_FILESYARAT="http://192.168.100.88/simrs/Web/assets/file/SYARAT_KETENTUAN.pdf";
//    public static final String URL_GAMBARBRG="http://macarinaid.wsjti.com/uploads/barang/";
}
