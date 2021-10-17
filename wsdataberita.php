<?php

	/*
	This web service is about a news database
	dataBerita = dataNews
	judul = NewsHeadline
	deskripsi = NewsDescription
	link = NewsURL
	tanggal = Published date of the news
	beritaArray = newsArray
	*/ 
	



    $ns = "http://".$_SERVER['HTTP_HOST']."/QNA_MHS/wsdataberita.php";//setting namespace
    require_once 'wsberita/lib/nusoap.php'; // load nusoap toolkit library in controller
    $server = new soap_server; // create soap server object
    $server->configureWSDL("WEB SERVICE BERITA MENGGUNAKAN SOAP WSDL", $ns); // wsdl configuration
    $server->wsdl->schemaTargetNamespace = $ns; // server namespace

    ########################DATA BERITA##############################################################
    // Complex Array Keys and Types kategori berita++++++++++++++++++++++++++++++++++++++++++
    $server->wsdl->addComplexType("dataBerita","complexType","struct","all","",
        array(
            
        "judul"=>array("name"=>"judul","type"=>"xsd:string"),
        "deskripsi"=>array("name"=>"deskripsi","type"=>"xsd:string"),
        "link"=>array("name"=>"link","type"=>"xsd:string"),
        "tanggal"=>array("name"=>"tanggal","type"=>"xsd:string")
        )
    );
    // Complex Array data Berita++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    $server->wsdl->addComplexType("beritaArray","complexType","array","","SOAP-ENC:Array",
        array(),
        array(
            array(
                "ref"=>"SOAP-ENC:arrayType",
                "wsdl:arrayType"=>"tns:dataBerita[]"
            )
        ),
        "dataBerita"
    );
    // End Complex Type kategori++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //create berita
    $input_create = array('judul' => "xsd:string",
        'deskripsi' => "xsd:string",
        'link' => "xsd:string",
        'tanggal' => "xsd:string",); // parameter create berita
    $return_create = array("return" => "xsd:string");
    $server->register('create',
        $input_create,
        $return_create,
        $ns,
        "urn:".$ns."/create",
        "rpc",
        "encoded",
        "Create new news entry");
    //end create berita
    //
    //delete kategori buku
    $input_delete = array(); // parameter hapus kategori
    $return_delete = array("return" => "xsd:string");
    $server->register('deleteall',
        $input_delete,
        $return_delete,
        $ns,
        "urn:".$ns."/deleteall",
        "rpc",
        "encoded",
        "Delete all news entry");
    //end delete kategori buku
    //
    //Ambil Semua Data kategori buku
    $input_readall = array(); // parameter ambil data kategori
    $return_readall = array("return" => "tns:beritaArray");
    $server->register('readall',
        $input_readall,
        $return_readall,
        $ns,
        "urn:".$ns."/readall",
        "rpc",
        "encoded",
        "Grab all news entry");
    //Ambil Semua Data kategori buku
    ################################Kategori BUKU#######################################################
    ###########################FUNCTION KATEGORI BUKU###################################################
    function create($kategoriBerita){
        require_once 'wsberita/classdb/classBerita.php';
        $kategori = new Classberita;
        if ($kategori->create($judul,$deskripsi,$url_berita,$tanggal)) {
            $respon = "sukses";
        }else{
            $respon = "error";
        }
        return $respon;
    }
    function readall(){
        require_once 'wsberita/classdb/classBerita.php';
        $berita = new Classberita;
        $hasil = $berita->readAll();
        $daftar = array();
        while ($item = $hasil->fetch_assoc()) {
            array_push($daftar, array('judul'=>$item['judul'],
                'deskripsi'=>$item['deskripsi'],
                'link'=>$item['link'],
                'tanggal'=>$item['tanggal']));
        }
        return $daftar;
    }
    function deleteall(){
        require_once 'wsberita/classdb/classBerita.php';
        $berita = new Classberita;
        if ($berita->deleteall()) {
            $respon = "sukses";
        }else{
            $respon = "error";
        }
        return $respon;
    }

    $server->service(file_get_contents("php://input"));
 ?>