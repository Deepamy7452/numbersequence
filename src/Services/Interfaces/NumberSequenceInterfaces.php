<?php
namespace Amy\Numbersequence\Services\Interfaces;

interface NumberSequenceInterfaces
{
    public function all();
    public function allMap();
    public function store_sequence($all_data);
    public function mapSequence($data);
    public function deleteSeq($id);
    public function showLogdetails($id);

}
