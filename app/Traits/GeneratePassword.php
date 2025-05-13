<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GeneratePassword
{
    /**
     * Tạo mật khẩu ngẫu nhiên theo định dạng mã sinh viên + @
     *
     * @param string $studentCode Mã sinh viên
     * @return string Mật khẩu được tạo
     */
    protected function generateRandomPassword($studentCode)
    {
        return $studentCode . '@';
    }
}
