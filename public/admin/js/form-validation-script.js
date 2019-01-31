var Script = function () {

    // $.validator.setDefaults({
    //     submitHandler: function() { alert("submitted!"); }
    // });

    $().ready(function() {
        // validate the comment form when it is submitted
        // $("#commentForm").validate();

        // validate signup form on keyup and submit
        $("#admin").validate({
            rules: {
                noi: "required",
                name: "required",
                position_id : "required",
                tahun : "required",
                firstname: "required",
                lastname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                nohp: {
                    minlength: 10,
                    maxlength: 12,
                    digits: true
                },
                agree: "required"
            },
            messages: {
                noi: "Masukkan nomor identitas",
                name: "Masukkan nama lengkap",
                position_id: "Pilih jabatan",
                tahun: "Pilih tahun menjabat",
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Masukkan Password",
                    minlength: "Password minimal 6 digit"
                },
                password_confirmation: {
                    required: "Masukkan Password",
                    minlength: "Password minimal 6 digit",
                    equalTo: "Masukkan Password yang sama"
                },
                nohp: {
                    minlength: "Nomor Telepon Minimal 7 Digit",
                    maxlength: "Nomor Telepon Maksimal 10 Digit",
                    digits: "Nomor Telepon Harus Angka"
                },
                email: "Masukkan email yang benar",
                agree: "Setujui persyaratan dengan mencentang"
            }
        });

        $("#registrasi").validate({
            rules: {
                kodepos: {
                    required: true,
                    minlength: 5,
                    maxlength: 5,
                    digits: true
                },
                notlp: {
                    required: true,
                    minlength: 7,
                    maxlength: 10,
                    digits: true
                },
                nmkepalasekolah: "required",
                nokepalasekolah: {
                    required: true,
                    minlength: 10,
                    maxlength: 12,
                    digits: true
                },
                nmcp: "required",
                nocp: {
                    required: true,
                    minlength: 10,
                    maxlength: 12,
                    digits: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
            },
            messages: {
                kodepos: {
                    required: "Masukkan Kode Pos",
                    digits: "Kode Pos Harus Angka",
                    minlength: "Kode Pos Harus 5 Digit",
                    maxlength: "Kode Pos Harus 5 Digit"
                },
                notlp: {
                    required: "Masukkan Nomor Telepon Sekolah",
                    minlength: "Nomor Telepon Minimal 7 Digit",
                    maxlength: "Nomor Telepon Maksimal 10 Digit",
                    digits: "Nomor Telepon Harus Angka"
                },
                nmkepalasekolah: "Masukkan Nama Kepala Sekolah",
                nokepalasekolah: {
                  required: "Masukkan Nomor Handphone",
                  minlength: "Nomor Telepon Minimal 10 Digit",
                  maxlength: "Nomor Telepon Maksimal 12 Digit",
                  digits: "Nomor Handphone Harus Angka"
                },
                nmcp: "Masukkan Nama Contact Person",
                nocp: {
                  required: "Masukkan Nomor Handphone",
                  minlength: "Nomor Telepon Minimal 10 Digit",
                  maxlength: "Nomor Telepon Maksimal 12 Digit",
                  digits: "Nomor Handphone Harus Angka"
                },
                email: "Masukkan email yang benar",
                password: {
                    required: "Masukkan Password",
                    minlength: "Password minimal 6 digit"
                },
                password_confirmation: {
                    required: "Masukkan Password",
                    minlength: "Password minimal 6 digit",
                    equalTo: "Masukkan Password yang sama"
                },
            }
        });

        $("#resetpassword").validate({
          rules: {
            email: {
                required: true,
                email: true
            },
          },
          messages: {
            email: {
                required: "Masukkan Email",
                email: "Masukkan Email dengan benar"
            },
          }
        });

        $("#createpassword").validate({
          rules: {
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
          },
          messages: {
            password: {
                required: "Masukkan Password",
                minlength: "Password minimal 6 digit"
            },
            password_confirmation: {
                required: "Masukkan Password",
                minlength: "Password minimal 6 digit",
                equalTo: "Masukkan Password yang sama"
            },
          }
        });

        $("#registrasimahasiswa").validate({
            rules: {
                nohp: {
                    required: true,
                    minlength: 10,
                    maxlength: 12,
                    digits: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
            },
            messages: {
                nohp: {
                  required: "Masukkan Nomor Handphone",
                  minlength: "Nomor Telepon Minimal 10 Digit",
                  maxlength: "Nomor Telepon Maksimal 12 Digit",
                  digits: "Nomor Handphone Harus Angka"
                },
                email: {
                  required: "Masukkan email yang benar",
                  email: "Masukkan email yang benar",
                },
                password: {
                    required: "Masukkan Password",
                    minlength: "Password minimal 6 digit"
                },
                password_confirmation: {
                    required: "Masukkan Password",
                    minlength: "Password minimal 6 digit",
                    equalTo: "Masukkan Password yang sama"
                },
            }
        });

        $("#createatletik").validate({
          rules: {
            atletik: "required",
            tgl_reg_mulai: "required",
            tgl_reg_akhir: "required",
            tgl_pay_mulai: "required",
            tgl_pay_akhir: "required",
            tgl_tm: "required",
            time_tm: "required",
            tmpt_tm: "required",
            biaya_sertifikat_atlit: "required",
            biaya_sertifikat_petugas: "required",
            biaya_buku_hasil: "required",
          },
          messages: {
            atletik: "Masukkan Nama Atletik",
            tgl_reg_mulai: "Masukkan Tanggal Mulai Pendaftaran",
            tgl_reg_akhir: "Masukkan Tanggal Akhir Pendaftaran",
            tgl_pay_mulai: "Masukkan Tanggal Mulai Pembayarann",
            tgl_pay_akhir: "Masukkan Tanggal Akhir Pembayarann",
            tgl_tm: "Masukkan Tanggal Technical Meeting",
            time_tm: "Masukkan Waktu Technical Meeting",
            tmpt_tm: "Masukkan Tempat Technical Meeting",
            biaya_sertifikat_atlit: "Masukkan Biaya Sertifikat Atlit",
            biaya_sertifikat_petugas: "Masukkan Biaya Sertifikat Petugas",
            biaya_buku_hasil: "Masukkan Biaya Buku Hasil",
          }
        });

        $("#createlomba").validate({
          rules: {
            nama: "required",
            jenjang: "required",
            umur: "required",
            max_pes: "required",
            biaya: "required",
            urutan: "required",
          },
          messages: {
            nama: "Masukkan Nama Lomba",
            jenjang: "Masukkan Jenjang",
            umur: "Masukkan Maksimal Umur",
            max_pes: "Masukkan Maksimal Peserta per Sekolah",
            biaya: "Masukkan Biaya",
            urutan: "Masukkan Urutan",
          }
        });

        $("#register").validate({
            rules: {
                agree: "required",
            },
            messages: {
                agree: "Harus setujui syarat dan ketentuan",
            }
        });

        $("#formulir").validate({
            rules: {
                name: "required",
                nis : {
                    required: true,
                    digits: true
                },
                placeborn : "required",
                dateborn: "required",
                jenjang: "required",
                photo: "required",
                rapor:"required"
            },
            messages: {
                name: "Masukkan nama lengkap",
                nis : {
                    required: "Masukkan nomor induk siswa",
                    digits: "NIS harus angka"
                },
                placeborn : "Masukkan tempat lahir",
                dateborn: "Masukkan tanggal lahir",
                jenjang: "Pilih salah satu jenjang",
                photo: "Harus ada foto",
                rapor:"Harus ada file rapor"
            }
        });

        $("#formulire").validate({
            rules: {
                name: "required",
                nis : {
                    required: true,
                    digits: true
                },
                placeborn : "required",
                dateborn: "required",
                jenjang: "required"
            },
            messages: {
                name: "Masukkan nama lengkap",
                nis : {
                    required: "Masukkan nomor induk siswa",
                    digits: "NIS harus angka"
                },
                placeborn : "Masukkan tempat lahir",
                dateborn: "Masukkan tanggal lahir",
                jenjang: "Pilih salah satu jenjang"
            }
        });

        $("#confirmation").validate({
            rules: {
                method: "required",
                an: "required",
                bank: "required",
                paymentdate : "required",
                amount : {
                    required: true,
                    digits: true
                },
                attachment: "required",
            },
            messages: {
                method: "Pilih salah satu tujuan pembayaran",
                an: "Masukkan atas nama pengirim",
                bank: "Masukkan nama bank",
                paymentdate : "Masukkan tanggal pembayaran",
                amount : {
                    required: "masukkan jumlah pembayaran",
                    digits: "jumlah uang harus angka tidak ada tambahan (.) titik atau (,)koma"
                },
                attachment: "Masukkan bukti pembayaran"
            }
        });

        $("#companion").validate({
            rules: {
                name: "required",
                notlp: {
                    minlength: 7,
                    maxlength: 10,
                    digits: true
                },
                nohp: {
                    required: true,
                    minlength: 10,
                    maxlength: 12,
                    digits: true
                },
                type: "required",
                photo: "required",
            },
            messages: {
                name: "Masukkan nama lengkap",
                notlp: {
                    required: "Masukkan Nomor Telepon",
                    minlength: "Nomor Telepon Minimal 7 Digit",
                    maxlength: "Nomor Telepon Maksimal 10 Digit",
                    digits: "Nomor Telepon Harus Angka"
                },
                nohp: {
                    required: "Masukkan Nomor Handphone",
                    minlength: "Nomor Telepon Minimal 10 Digit",
                    maxlength: "Nomor Telepon Maksimal 12 Digit",
                    digits: "Nomor Handphone Harus Angka"
                },
                type: "Pilih Petugas",
                photo: "Masukkan Foto",
            }
        });

        $("#companionEdit").validate({
            rules: {
                name: "required",
                notlp: {
                    minlength: 7,
                    maxlength: 10,
                    digits: true
                },
                nohp: {
                    required: true,
                    minlength: 10,
                    maxlength: 12,
                    digits: true
                },
                type: "required",
            },
            messages: {
                name: "Masukkan nama lengkap",
                notlp: {
                    required: "Masukkan Nomor Telepon",
                    minlength: "Nomor Telepon Minimal 7 Digit",
                    maxlength: "Nomor Telepon Maksimal 10 Digit",
                    digits: "Nomor Telepon Harus Angka"
                },
                nohp: {
                    required: "Masukkan Nomor Handphone",
                    minlength: "Nomor Telepon Minimal 10 Digit",
                    maxlength: "Nomor Telepon Maksimal 12 Digit",
                    digits: "Nomor Handphone Harus Angka"
                },
                type: "Pilih Petugas",
            }
        });

        $("#position").validate({
            rules: {
                name: "required",
            },
            messages: {
                name: "Masukkan nama jabatan",
            }
        });

        $("#sponsor").validate({
            rules: {
                name: "required",
                logo: "required",
            },
            messages: {
                name: "Masukkan nama sponsor",
                logo: "Upload logo",
            }
        });

        $("#skema").validate({
            rules: {
                seri: "required",
                nodada: "required",
                nolint: "required",
            },
            messages: {
                seri: "Pilih seri lomba",
                nodada: "Pilih nomor dada",
                nolint: "Pilih no.lint/no urut",
            }
        });

        $("#skemai").validate({
            rules: {
                tahun: "required",
                jenjang: "required",
                nocontest: "required",
            },
            messages: {
                tahun: "Pilih tahun",
                jenjang: "Pilih jenjang",
                nocontest: "Pilih lomba",
            }
        });

        $("#cetakskema").validate({
            rules: {
                tahun: "required",
                jenjang: "required",
                nocontest: "required",
                seri: "required",
                tipe: "required",
                output: "required",
            },
            messages: {
                tahun: "Pilih tahun",
                jenjang: "Pilih jenjang",
                nocontest: "Pilih lomba",
                seri: "Pilih seri",
                tipe: "Pilih tipe",
                output: "Pilih output file",
            }
        });

        $("#document").validate({
            rules: {
                name: "required",
                file: "required",
            },
            messages: {
                name: "Masukkan nama dokumen",
                file: "Pilih file",
            }
        });

        $("#rekor").validate({
            rules: {
                nolomba: "required",
                nama: "required",
                pendidikan: "required",
                prestasi: "required",
                tahun: "required",
            },
            messages: {
                nolomba: "Masukkan nomor lomba",
                nama: "Masukkan nama atlit",
                pendidikan: "Masukkan asal sekolah",
                prestasi: "Masukkan prestasi yang diraih",
                tahun: "Masukkan tahun",
            }
        });

        $("#logbook").validate({
            rules: {
                tgl: "required",
                tempat: "required",
                kegiatan: "required",
                hasil: "required",
            },
            messages: {
                tgl: "Pilih tanggal",
                tempat: "Masukkan tempat kegiatan",
                kegiatan: "Masukkan kegiatan",
                hasil: "Masukkan Hasil",
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();
