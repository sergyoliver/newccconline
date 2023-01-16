import uuid

from django.db import models
from django.db.models.signals import pre_save, post_save
from utilisateur.models import Sousprefecture


class Village(models.Model):
    class Meta:
        db_table = "tb_village"

    id = models.BigIntegerField( blank=True, default=0)
    uuid = models.UUIDField(unique=True, blank=True, default=None)
    designation = models.CharField(max_length=50, default="", blank=True)
    code_village = models.CharField(primary_key=True,max_length=50, blank=True, default=None)
     sous_prefecture_code = models.ForeignKey(Sousprefecture, on_delete=models.DO_NOTHING,
                                                  blank=True, default=0, related_name="souspprefectures")
    active = models.IntegerField(blank=True, default=1, db_column="statut")
     supp = models.IntegerField(default=0,help_text="ce champs peut avoir que 2 valeur 1 0 ")
    id_supp = models.IntegerField(default=0, blank=True, null=true)
    id_modification = models.IntegerField(default=0, blank=True, null=true)
    id_enregistrement = models.IntegerField(default=0, blank=True)
    date_creation = models.DateTimeField(auto_now_add=True, editable=False, null=true)
    date_modification = models.DateTimeField(auto_now=True, null=true)
    date_destruction = models.DateTimeField(auto_now=True, null=true)
    date_suppression = models.DateTimeField(auto_now=False, auto_created=False, default='', blank=True, null=true)


    def __str__(self):
        return self.designation

    def save(self, *args, **kwargs):
        if self.id is None or self.id ==0:
            try:
                self.id = Delegation.objects.latest('id').id + 1
            except Delegation.DoesNotExist:
                self.id = 1

        if self.uuid is None:
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()
                print(e)

        super(Delegation, self).save()


class Departement(models.Model):
    class Meta:
        db_table = "tb_departement"

    id = models.BigIntegerField(primary_key=True, blank=True, default=0)
    uuid = models.UUIDField(unique=True, blank=True, default="")
    code_departement = models.CharField(max_length=50, blank=True, default=None)
    designation = models.CharField(max_length=50, default="", unique=True)
    delegation = models.ForeignKey(Delegation, on_delete=models.DO_NOTHING,  related_name="departements")
    delegation_code = models.CharField(max_length=30, default="", blank=True)
    active = models.IntegerField(default=1)
    date_creation = models.DateTimeField(auto_now_add=True)
    date_modification = models.DateTimeField(auto_now=True)

    def __str__(self):
        return self.designation

    def save(self, *args, **kwargs):

        if self.id is None:
            try:
                self.id = Departement.objects.latest('id').id + 1
            except Departement.DoesNotExist:
                self.id = 1

        if self.uuid is None or self.uuid == "":
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()
                print(e)
        self.delegation_code = self.delegation.code_delegation

        super(Departement, self).save()


class SousPrefecture(models.Model):
    id = models.BigIntegerField(primary_key=True, blank=True, default=None)
    uuid = models.UUIDField(unique=True, blank=True, default=None)

    code_sous_prefecture = models.CharField(max_length=15, blank=True, default=None, unique=True)
    designation = models.CharField(max_length=30, unique=True)
    departement = models.ForeignKey(Departement, on_delete=models.CASCADE, related_name='sousprefectures')
    departement_code = models.CharField(max_length=30, blank=True, default=None)

    active = models.IntegerField(blank=True, default=1)
    date_creation = models.DateTimeField(auto_now_add=True)
    date_modification = models.DateTimeField(auto_now=True)

    def __str__(self):
        return self.designation

    def save(self, *args, **kwargs):
        if self.id is None:
            try:
                self.id = SousPrefecture.objects.latest('id').id + 1
            except SousPrefecture.DoesNotExist:
                self.id = 1

        if self.departement_code is None or len(str(self.departement_code)) <= 1:
            self.departement_code = self.departement.code_departement

        if self.uuid is None:
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()
                print(e)

        super(SousPrefecture, self).save()


class Village(models.Model):
    id = models.BigIntegerField(primary_key=True, default=None, blank=True)
    uuid = models.UUIDField(unique=True, blank=True, default=None)

    code_village = models.CharField(max_length=15, blank=True, default=None, unique=True)
    designation = models.CharField(max_length=30, unique=True)
    sous_prefecture = models.ForeignKey(SousPrefecture, on_delete=models.CASCADE, related_name='villages')
    sous_prefecture_code = models.CharField(max_length=30, blank=True, default=None)

    active = models.IntegerField(blank=True, default=1)
    date_creation = models.DateTimeField(auto_now_add=True)
    date_modification = models.DateTimeField(auto_now=True)

    def __str__(self):
        return self.designation

    def save(self, *args, **kwargs):
        if self.id is None:
            try:
                self.id = Village.objects.latest('id').id + 1
            except Village.DoesNotExist:
                self.id = 1

        if self.sous_prefecture_code is None or len(str(self.sous_prefecture_code)) <= 1:
            self.sous_prefecture_code = self.sous_prefecture.code_sous_prefecture

        if self.uuid is None:
            try:
                self.uuid = uuid.uuid4()
            except Exception as e:
                self.uuid = uuid.uuid4()
                print(e)

        super(Village, self).save()


def delegationSignal(sender, instance: Delegation, **kwargs):

    if instance.code_delegation is None or len(str(instance.code_delegation)) <= 2:
        pk = ''
        if instance.id <= 9:
            pk = '00' + str(instance.id)
        if 99 >= instance.id > 9:
            pk = '0' + str(instance.id)
        instance.code_delegation = str(instance.designation)[0:3].upper() + pk
        instance.save()


def departementSignal(sender, instance: Departement, **kwargs):
    if instance.code_departement is None or len(str(instance.code_departement)) <= 2:
        pk = 'D'
        if instance.id <= 9:
            pk = 'D00' + str(instance.id)
        if 99 >= instance.id > 9:
            pk = 'D0' + str(instance.id)
        instance.code_departement = str(instance.delegation.code_delegation) + pk
        instance.save()


def sousPrefectureSignal(sender, instance: SousPrefecture,created, **kwargs):
    if instance.code_sous_prefecture is None or len(str(instance.code_sous_prefecture)) <= 2:
        pk = ''
        if instance.id <= 9:
            pk = 'S00' + str(instance.id)
        if 99 >= instance.id > 9:
            pk = 'S0' + str(instance.id)
        instance.code_sous_prefecture = str(instance.departement.code_departement) + pk
        instance.save()

    if instance.departement_code is None:
        instance.departement_code = instance.departement.code_departement
        instance.save()


def VillageSignal(sender, instance: Village,created, **kwargs):
    if instance.code_village is None or len(str(instance.code_village)) <= 2:
        pk = 'V'
        if instance.id <= 9:
            pk = 'V00' + str(instance.id)

        if 99 >= instance.id > 9:
            pk = 'V0' + str(instance.id)
        instance.code_village = str(instance.sous_prefecture.code_sous_prefecture) + pk
        instance.save()

    if instance.sous_prefecture_code is None:
        instance.sous_prefecture_code = instance.sous_prefecture.code_sous_prefecture
        instance.save()


post_save.connect(delegationSignal, sender=Delegation)
post_save.connect(departementSignal, sender=Departement)
post_save.connect(sousPrefectureSignal, sender=SousPrefecture)
post_save.connect(VillageSignal, sender=Village)
