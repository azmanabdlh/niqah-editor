interface BlockAttribute 
{
  style: string;
  className: string;
  id: string;
}

interface ContainerAttribute extends BlockAttribute 
{

}

interface TextAttribute extends BlockAttribute 
{

}



type BlockTypeAttribute = {
  __Container: ContainerAttribute; 
  __Text: TextAttribute;
}

export type BlockType = keyof BlockTypeAttribute

export type AttributeSet = Partial<Record<keyof BlockType[keyof BlockType], string>>;




interface BlockBehavior {
  init?: (element?: HTMLElement) => void;  
};


export interface TextBehavior extends BlockBehavior {
  onChange?: (newText: string) => void;
}

export type BlockBehaviorContext = {
  __Text: TextBehavior;
}

export type BlockBehaviorKind = keyof BlockBehaviorContext;




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
