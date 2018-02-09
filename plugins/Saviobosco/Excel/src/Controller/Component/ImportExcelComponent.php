<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/16/17
 * Time: 10:36 AM
 */

namespace Saviobosco\Excel\Controller\Component;


use Cewi\Excel\Controller\Component\ImportComponent;

/**
 * The MIT License
 *
 * Copyright 2017 saviobosco <Johnboscoomebe@yahoo.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * CakePHP Import Component
 *
 * @author saviobosco <Johnboscoomebe@yahoo.com>
 */
class ImportExcelComponent extends ImportComponent
{
    public function prepareEntityData($file = null, array $options = [])
    {
        $result = [];
        $excelResults = parent::prepareEntityData($file,$options);
        $result[0] = $excelResults;
        $result[1] = count($excelResults);

        return $result;
    }

}