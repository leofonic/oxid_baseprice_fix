<?php
class baseprice_fix_oxarticle extends baseprice_fix_oxarticle_parent
{
    protected $_oFromVariant = null;
    
    public function getUnitPrice()
    {
        if ($oVariant = $this->_zw_getFromVariant()){
            return $oVariant->getUnitPrice();
        }
        return parent::getUnitPrice();
    }
    public function getUnitName()
    {
        if ($oVariant = $this->_zw_getFromVariant()){
            if ($oVariant->getUnitName()){
                return $oVariant->getUnitName();
            }
        }
        return parent::getUnitName();
    }
    public function getUnitQuantity()
    {
        if ($oVariant = $this->_zw_getFromVariant()){
            if ($oVariant->getUnitQuantity()){
                return $oVariant->getUnitQuantity();
            }
        }
        return parent::getUnitQuantity();
    }
    
    protected function _zw_getFromVariant(){
        if ($this->_oFromVariant === null && $this->isRangePrice()){
            $this->_oFromVariant = false;
            $sPriceSuffix = $this->_getUserPriceSufix();
            $dVarMinPrice = $this->_getVarMinPrice();
            $dPrice = $this->_getPrice();
            if ($dVarMinPrice !== null && $dPrice > $dVarMinPrice) {
                $sSql = 'SELECT oxid ';
                $sSql .= ' FROM ' . $this->getViewName(true) . '
                WHERE ' . $this->getSqlActiveSnippet(true) . '
                    AND ( `oxparentid` = ' . oxDb::getDb()->quote($this->getId()) . ' )
                    AND (`oxprice' . $sPriceSuffix . '` = ' . oxDb::getDb()->quote($dVarMinPrice) . ' )
                    Limit 1';
                $sOxid = oxdb::getDb()->getOne($sSql);
                $oVariant = oxnew('oxarticle');
                if ($oVariant->load($sOxid)){
                    $this->_oFromVariant = $oVariant;
                }
            }
        }
        return $this->_oFromVariant;
    }
}