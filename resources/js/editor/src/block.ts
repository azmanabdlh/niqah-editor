interface BlockAttribute {
  style: string;
  className: string;
  id: string;
}

interface ContainerAttribute extends BlockAttribute {

}

type AttributeType = {
  "__Container": ContainerAttribute;  
}

type AttributeSet = Partial<Record<keyof AttributeType[keyof AttributeType], string>>;

class Block {
  id: number;
  name: string
  node: string;
  type: keyof AttributeType;
  attributes: AttributeSet;
  children: Block[];

  constructor(
    id: number, 
    name: string, 
    node: string, 
    type: keyof AttributeType, 
    attributes: AttributeSet,
    children: Block[]
  ) {
    this.id = id;
    this.name = name;
    this.node = node;
    this.type = type;
    this.attributes = attributes;
    this.children = children;
  }

}



