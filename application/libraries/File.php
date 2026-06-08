<?php

/** 
 * @author Kanny
 */
class File
{
    public static $obj;

    private static function __init($FILE)
    {
        self::$obj = new \Verot\Upload\Upload($FILE);
    }

    public static function uploadPhoto($FILE, $folder = '', $name = false)
    {
        $photo  = '';
        //        $handle = self::__init( $FILE );
        $handle = new \Verot\Upload\Upload($FILE);
        if ($handle->uploaded) {
            $handle->image_resize   = true;
            $handle->image_ratio    = true;
            $handle->image_x        = 250;
            $handle->image_y        = 250;
            $handle->jpeg_quality   = 100;
            $handle->file_overwrite = true;
            $handle->file_new_name_body = ($name) ? $name : uniqid();
            $handle->Process("{$folder}");
            $photo = stripslashes($handle->file_dst_pathname);
            if ($handle->processed) {
                $handle->clean();
            }
        }
        return $photo;
    }

    public static function uploadRaw($FILE, $folder = '', $name = false)
    {
        $photo  = '';
        $handle = new \Verot\Upload\Upload($FILE);
        if ($handle->uploaded) {
            $handle->file_new_name_body = $name ?: md5(time());
            $handle->Process("uploads/{$folder}/");
            $photo = stripslashes($handle->file_dst_pathname);
            if ($handle->processed) {
                $handle->clean();
            }
        }
        return $photo;
    }

    public static function getPhoto($photo)
    {
        $filename = dirname(BASEPATH) . '/' . $photo;
        if ($photo && file_exists($filename)) {
            return stripslashes($photo);
        } else {
            return 'uploads/no-photo.jpg';
        }
    }

    public static function delete($file_full_path = '')
    {
        $filename = dirname(BASEPATH) . "/{$file_full_path}";
        if ($file_full_path && file_exists($filename)) {
            return unlink($file_full_path);
        }
    }

    public static function base64UploadOriginal($base64_content, $name)
    {

        $index  = date('Y/m');
        $path   = "uploads/review/share/{$index}/";

        $handle = new \Verot\Upload\Upload($base64_content);
        if ($handle->uploaded) {
            $handle->file_new_name_body     = $name;
            $handle->allowed                = array('image/*');
            $handle->file_force_extension   = true;
            $handle->file_overwrite         = true;
            $handle->file_new_name_ext      = 'jpg';
            $handle->jpeg_quality           = 100;
            $handle->process($path);
            if ($handle->processed) {
                return stripslashes($handle->file_dst_pathname);
            } else {
                return '';
            }
        }
    }

    public static function base64Upload($base64_content, $name, $path)
    {
        $path   = "uploads/{$path}/";
        $handle = new \Verot\Upload\Upload($base64_content);
        if ($handle->uploaded) {
            $handle->file_new_name_body     = $name;
            $handle->allowed                = array('image/*');
            $handle->file_force_extension   = true;
            $handle->file_overwrite         = true;
            $handle->file_new_name_ext      = 'jpg';
            $handle->jpeg_quality           = 100;
            $handle->process($path);
            if ($handle->processed) {
                return stripslashes($handle->file_dst_pathname);
            } else {
                return '';
            }
        }
    }

    public static function uploadLogo($saas_id, $File, $old_src = '')
    {
        $handle = new \Verot\Upload\Upload($File);
        if ($handle->uploaded) {
            $handle->file_new_name_body     = uniqid('logo-');
            $handle->file_overwrite         = true;
            $handle->image_no_enlarging     = false;
            $handle->image_y                = 300;
            $handle->image_x                = 300;
            $handle->image_ratio_y          = true;
            $handle->image_resize           = true;

            $handle->process("uploads/{$saas_id}/");
            if ($handle->processed) {
                return stripslashes($handle->file_dst_pathname);
            }
        }
        return $old_src;
    }

    public static function delDir($dir) { 
        if (is_dir($dir)) { 
          $objects = scandir($dir);
          foreach ($objects as $object) { 
            if ($object != "." && $object != "..") { 
              if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                self::delDir($dir. DIRECTORY_SEPARATOR .$object);
              else
                unlink($dir. DIRECTORY_SEPARATOR .$object); 
            } 
          }
          rmdir($dir); 
        } 
    }


    public static function uploadFile($rel_tbl,$rel_id) {
        $saas_id    = getLoginUserData('saas_id');        
        $folder     = "{$saas_id}/" . date('Y/m');
        if (!empty($_FILES['attach']['name'])) {
            $files = [];
            foreach ($_FILES['attach'] as $label => $file) {
                foreach ($file as $i => $v) {
                    $files[$i][$label] = $v;
                }
            }
            foreach ($files as $file) {
                if ($file['error'] == 0) {
                    $file_name = uniqid($rel_id);
                    $attach    = File::uploadRaw($file, $folder, $file_name);
                    $object    = [
                        'saas_id'     => $saas_id,
                        'user_id'     => getLoginUserData('user_id'),
                        'rel_tbl'     => $rel_tbl,
                        'rel_id'      => $rel_id,
                        'name'        => $file['name'],
                        'size'        => $file['size'],
                        'type'        => $file['type'],
                        'path'        => $attach,
                        'uploaded_at' => date('Y-m-d H:i:s'),
                    ];
                    get_instance()->db->insert('attachments', $object);
                }
            }
        }
    }
}
