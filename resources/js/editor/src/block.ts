interface BlockAttribute 
{
  style: string;
  className: string;
  id: string;
}

interface ContainerAttribute extends BlockAttribute 
{

}



type BlockTypeAttribute = {
  "__Container": ContainerAttribute;  
}

export type BlockType = keyof BlockTypeAttribute

export type AttributeSet = Partial<Record<keyof BlockType[keyof BlockType], string>>;

export default class Block {
  id: number;
  name: string
  node: string;
  type: keyof BlockType;
  attributes: AttributeSet;
  children: Block[];

  constructor(
    id: number, 
    name: string, 
    node: string, 
    type: keyof BlockType, 
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



