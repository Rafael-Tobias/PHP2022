from filecmp import clear_cache
import PyPDF2

#ABRINDO ARQUIVO PDF
pdf_file = open('pdfFile.pdf','rb')
dados_pdf = PyPDF2.PdfFileReader(pdf_file)

#ABRINDO0 ARQUIVO TXT
file = open("teste.txt", 'w', encoding="utf-8")
file.seek(0,0)

#ESCREVENDO PDF NO TXT
quantidade_paginas_arquivo = dados_pdf.numPages
for i in range(0, quantidade_paginas_arquivo):
    pagina1 = dados_pdf.getPage(i)
    file.write(str(pagina1.extractText()))

file.seek(0,0)
file.close()

#LENDO ARQUIVO
file = open("teste.txt", 'r', encoding="utf-8")
file.seek(0,0)

string_linhas_arquivo = file.readlines()

#QUANTIDADE DE LINHAS DO ARQUIVO
quantidade_linhas_arquivo = len(string_linhas_arquivo)

#LOCALIZANDO OBJETIVOS DE APRENDIZAGEM
for i in range(0, quantidade_linhas_arquivo):
    if 'OBJETIVOS DE APRENDIZAGEM' in string_linhas_arquivo[i]:
        encontrou_objetivos = i
    if 'EMENTA' in string_linhas_arquivo[i]:
        encontrou_ementa = i
        break

#GUARDANDO CONTEUDO DE OBJETIVOS DE APRENDIZGEM
objetivos_aprendizagem = []
for i in range(encontrou_objetivos, encontrou_ementa):
    objetivos_aprendizagem.append(string_linhas_arquivo[i].replace("\n",""))





#------------------------------------//------------------------------------
#LOCALIZANDO CONTEÚDOS
encontrou_conteudos = 0
for i in range(0, quantidade_linhas_arquivo):
    if 'CONTEÚDOS' in string_linhas_arquivo[i]:
        encontrou_conteudos = i

#GUARDANDO CONTEUDO DE PLANOS DE APRENDIZGEM
conteudos = []
for i in range(encontrou_conteudos, quantidade_linhas_arquivo):
    conteudos.append(string_linhas_arquivo[i])




#---------------------------------//------------------------------------
#LOCALIZANDO CONTEÚDOS
for i in range(0, quantidade_linhas_arquivo):
    if 'CONTEUDO:' in string_linhas_arquivo[i]:
        encontrou_referencia_basica = i
    if 'BIBLIOGRAFIA COMPLEMENTAR:' in string_linhas_arquivo[i]:
        encontrou_referencia_complementar = i
    if 'SEMESTRE: 1' in string_linhas_arquivo[i] and i > 5:
        encontrou_semestre = i

#GUARDANDO CONTEUDOS DE REFERENCIAS BASICAS
referencia_basica = []
for i in range(encontrou_referencia_basica, encontrou_referencia_complementar):
    referencia_basica.append(string_linhas_arquivo[i])

#GUARNDANDO CONTEUDOS DE REFERENCIAS COMPLEMENTAR
referencia_complementar = []
for i in range(encontrou_referencia_complementar, encontrou_semestre):
    referencia_complementar.append(string_linhas_arquivo[i])


#APRESENTANDO NA TELA OBJETIVOS DE APRENDIZGAEM
print("\n\n\n")
print("".join(objetivos_aprendizagem))
print("\n\n\n\n\n\n")

#APRESENTANDO NA TELA CONTEUDO ESTUDADO
print("".join(conteudos).replace("\n\n", ""))
print("\n\n\n\n\n\n")

#APRESENTANDO NA TELA REFERENCIAS BASICAS
print("".join(referencia_basica).replace("\n","").replace("..","").replace(".,",""))
print("\n\n\n\n\n\n")

#APRESENTANDO NA TELA REFERENCIAS COMPLEMENTARES
print("".join(referencia_complementar).replace("\n","").replace("..","").replace(".,",""))
print("\n\n\n\n\n\n")