pragma solidity ^0.5.0;

contract trade{





    event Newitem(uint itemId, string owner, uint price);
    event itemSold(uint itemiId, address seller, address buyer);
    event NewUser(uint tokenamount);

    struct item{
        string owner;
        uint itemId;
        uint price;
        address ownerAddress;
    }


    item[ 2^256-1] itemForSell;


    mapping (address => uint) itemsOwn;
    mapping (address => uint) amountOwn;
    mapping (address => uint) tokenOwn;
    mapping (address=>bool) initialized;

        address isowner;

        modifier owner{
            require(msg.sender==isowner);
            _;
        }

        constructor () public {
            isowner = msg.sender;
        }



        function register() public owner{

            require(initialized[msg.sender]==false);
            initialized[msg.sender]=true;
            tokenOwn[msg.sender]=500;
            emit NewUser(500);

        }


        function buy(string memory _newOwner, uint  _itemId) public owner{
          item memory getItem = itemForSell[_itemId];
          require(msg.sender!=getItem.ownerAddress);
          require(tokenOwn[msg.sender]>=getItem.price);
          tokenOwn[msg.sender]-=getItem.price;
          tokenOwn[getItem.ownerAddress]+=getItem.price;
          amountOwn[getItem.ownerAddress]-=1;
          getItem.ownerAddress = msg.sender;
          getItem.owner =_newOwner;
          uint confirmId = uint(keccak256(abi.encodePacked(_itemId)));
          itemsOwn[msg.sender]=confirmId;
          emit itemSold(confirmId ,getItem.ownerAddress, msg.sender);
           amountOwn[msg.sender]++;
        }

        function putItemOnSell(string  memory _owner, uint _itemID, uint _price) public owner{
            require(keccak256(abi.encodePacked(_owner))!=keccak256(abi.encodePacked(itemForSell[_itemID].owner)));
            itemForSell[_itemID] =item(_owner,_itemID, _price, msg.sender);        //add to an array into specific index
            uint confirmId =uint(keccak256(abi.encodePacked(_itemID)));
            itemsOwn[msg.sender] = confirmId;
            amountOwn[msg.sender]++;
            emit Newitem(confirmId, _owner, _price);       //brodcast into blockchain
        }

        function viewOwner(uint _itemID) public owner view returns(string memory){
            return itemForSell[_itemID].owner;

        }
        function viewAmountOwn() public owner view returns(uint){
            return amountOwn[msg.sender];

        }
        function viewTokenOwn() public view owner returns(uint){
            return tokenOwn[msg.sender];

        }
}
